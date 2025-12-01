<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"])) header("Location: home.php");
$pizzas = $conn->query("SELECT * FROM pizzas")->fetch_all(MYSQLI_ASSOC);
$role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizzeria</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Pizzeria</h1>
            <nav>
                <a href="history.php">Mes commandes</a>
                <?php if($role === 'admin'): ?>
                <a href="add_pizza.php">Ajouter Pizza</a>
                <?php endif; ?>
                <a href="logout.php">Déconnexion</a>
            </nav>
        </header>

        <div class="container">
            <h2>Notre Menu</h2>

            <div class="pizza-grid">
                <?php foreach($pizzas as $p): ?>

                    <div class="pizza-card">
                        <img src="images/<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                        <h3><?= $p['name'] ?></h3>
                        <p><?= $p['ingredients'] ?></p>
                        <p><?= $p['price'] ?>€</p>
                        <button class="addCart" data-name="<?= $p['name'] ?>" data-price="<?= $p['price'] ?>">Ajouter</button>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div id="cart">
                    <h3>Mon panier</h3>
                    <div id="cart-items"></div>
                    <p id="cart-total">Total : 0€</p>
                </div>

                <div class="delivery-box">
                    <input type="text" id="address" placeholder="Adresse complète">
                    <input type="text" id="city" placeholder="Ville">
                    <input type="text" id="postal" placeholder="Code postal">
                    <button id="saveDelivery">Enregistrer l'adresse</button>
                </div>

                <button id="orderBtn" class="order-btn">Valider la commande</button>
            </div>
            <script src="script.js"></script>
    </body>
</html>
