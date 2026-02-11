<?php

$host = "localhost";
$db = "amoras"; 
$user = "root";
$pass = "";

try {

    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    // faz o PHP mostrar erros reais
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    die("Erro na conexão: " . $e->getMessage());

}

?>
