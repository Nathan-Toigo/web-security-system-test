<?php
$dsn = 'mysql:host=db;dbname=myapp;charset=utf8';
$user = 'user';
$password = 'userpassword';

try {
    $pdo = new PDO($dsn, $user, $password);
    echo "Connexion réussie à la base de données MySQL!";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
