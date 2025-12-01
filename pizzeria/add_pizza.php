<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'admin'){
    header("Location: home.php"); exit;
}

$error = "";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = trim($_POST["name"]);
    $price = floatval($_POST["price"]);
    $img_name = $_FILES["image"]["name"];
    $img_tmp = $_FILES["image"]["tmp_name"];
    if($name && $price && $img_name){
        $target = "images/".basename($img_name);
        if(move_uploaded_file($img_tmp,$target)){
            $stmt = $conn->prepare("INSERT INTO pizzas (name,price,img) VALUES (?,?,?)");
            $stmt->bind_param("sds",$name,$price,$img_name);
            if($stmt->execute()){ $success = "Pizza ajoutée !"; }
            else { $error = "Erreur BDD"; }
        } else { $error = "Erreur upload"; }
    } else { $error = "Tous les champs sont requis"; }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Ajouter Pizza</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="auth-box">
            <h2>Ajouter Pizza</h2>
            <?php if($error) echo "<p class='error'>$error</p>"; ?>
            <?php if(!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Nom de la pizza" required>
                <input type="number" step="0.01" name="price" placeholder="Prix (€)" required>
                <input type="file" name="image" accept="images/*" required>
                <button>Ajouter</button>
            </form>
            <a href="index.php">Retour</a>
        </div>
        
    </body>
</html>
