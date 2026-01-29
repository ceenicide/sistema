<?php
$host = 'localhost';
$db   = 'restaurante_db';
$user = 'root'; // ajuste conforme seu ambiente
$pass = '159951';     // ajuste conforme seu ambiente

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}