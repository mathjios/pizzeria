<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"])) header("Location: auth.php");
$user=$_SESSION["user_id"];
$res=$conn->query("SELECT * FROM orders WHERE user_id=$user ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Historique des commandes</title>
    </head>

    <body>

        <header>
        <h1>Mes commandes</h1>
        <a href="index.php">Retour</a>
        </header>
        
        <div class="container">
            <?php while($o=$res->fetch_assoc()): $items=json_decode($o["order_json"],true); ?>
            
            <div class="order-box">
                <h3>Commande #<?= $o["id"] ?> — <?= $o["total_price"] ?>€</h3>
                <p><b>Adresse :</b> <?= $o["address"] ?>, <?= $o["city"] ?> <?= $o["postal_code"] ?></p>
                <?php foreach($items as $p): ?>
                    <p><?= $p["qty"] ?>× <?= $p["name"] ?> (<?= $p["price"] ?>€/u)</p>
                    <?php endforeach; ?>
                    <small><?= $o["created_at"] ?></small>
                </div>

            <?php endwhile; ?>
        </div>
    </body>
</html>
