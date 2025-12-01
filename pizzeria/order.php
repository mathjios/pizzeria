<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"])) exit(json_encode(["message"=>"Utilisateur non connecté."]));
$data=json_decode(file_get_contents("php://input"),true);
if(!$data) exit(json_encode(["message"=>"Données invalides."]));
$cart=$data["cart"]??[];
$delivery=$data["delivery"]??[];
$user_id=$_SESSION["user_id"];

if(empty($cart) || empty($delivery)) exit(json_encode(["message"=>"Panier ou adresse vide."]));
$total=0;
foreach($cart as $p) $total += $p["price"] * $p["qty"];
$json = json_encode($cart, JSON_UNESCAPED_UNICODE);
$stmt = $conn->prepare("INSERT INTO orders (user_id, order_json, total_price, address, city, postal_code) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("isdsss", $user_id, $json, $total, $delivery["address"], $delivery["city"], $delivery["postal"]);
$stmt->execute();

echo json_encode(["message"=>"Commande validée !"]);
