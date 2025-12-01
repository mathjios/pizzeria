<?php
session_start();
require "db.php";

$mode = $_GET["mode"] ?? "login";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["action"] === "register") {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Validation simple du téléphone : uniquement chiffres, +, -, espaces
        if(!preg_match("/^[0-9+\-\s]{6,20}$/", $phone)){
            $error = "Numéro de téléphone invalide.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username,email,phone,password) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $username, $email, $phone, $password);
            if($stmt->execute()){
                header("Location: auth.php?mode=login");
                exit;
            } else { 
                $error="Erreur lors de l'inscription ou email déjà utilisé."; 
            }
        }

    } elseif ($_POST["action"] === "login") {
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT id,password,role FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows === 1){
            $user = $res->fetch_assoc();
            if(password_verify($password, $user["password"])){
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["role"] = $user["role"];
                header("Location: index.php");
                exit;
            } else { $error="Email ou mot de passe incorrect."; }
        } else { $error="Email ou mot de passe incorrect."; }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $mode==="login" ? "Connexion" : "Inscription" ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-box">
        <?php if($error) echo "<p class='error'>$error</p>"; ?>

        <?php if($mode==="login"): ?>
            <h2>Connexion</h2>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button>Se connecter</button>
            </form>
            <a href="auth.php?mode=register">Créer un compte</a>

        <?php else: ?>
            <h2>Inscription</h2>
            <form method="POST">
                <input type="hidden" name="action" value="register">
                <input type="text" name="username" placeholder="Nom" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Téléphone" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button>S'inscrire</button>
            </form>
            <a href="auth.php?mode=login">Déjà un compte ?</a>
        <?php endif; ?>
    </div>
</body>
</html>
