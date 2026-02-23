<?php

require 'conexao.php';

// pega os dados
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);


// 🔎 VERIFICA EMAIL
$sql = "INSERT INTO cadastro_das_amoras (nome, email, senha, tipo)
        VALUES (?, ?, ?, 'user')";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $senhaHash]);

if($stmt->rowCount() > 0){
    die("Email já cadastrado!");
}


// ✅ AGORA SIM — INSERT
$sql = "INSERT INTO cadastro_das_amoras (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $senhaHash]);


// redireciona
header("Location: login.php");
exit();

?>
