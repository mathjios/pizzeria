<?php
require "db.php";
$pizzas = $conn->query("SELECT * FROM pizzas")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenue à la Pizzeria</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <header>
            <h1>Pizzeria</h1>
            <nav>
            <a href="auth.php?mode=login">Connexion</a>
            <a href="auth.php?mode=register">Inscription</a>
            </nav>
        </header>
        
        <div class="container">
            <h2>Bienvenue à notre Pizzeria !</h2>
            <p>Découvrez nos délicieuses pizzas artisanales. Connectez-vous pour commander !</p>

            <div class="pizza-grid">
                <?php foreach($pizzas as $p): ?>
                    <div class="pizza-card">
                        <img src="images/<?= $p['img'] ?>" alt="<?= $p['name'] ?>">
                        <h3><?= $p['name'] ?></h3>
                        <p><?= $p['price'] ?>€</p>
                        <a href="auth.php?mode=login" class="addCart">Commander</a>
                    </div>

                    <?php endforeach; ?>
            </div>
        </div>
        
    </body>
</html>
