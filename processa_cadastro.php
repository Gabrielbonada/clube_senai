<?php

require 'conexao.php';

// pega os dados
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);


// 🔎 VERIFICA EMAIL
$sql = "SELECT id FROM cadastro_das_amoras WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

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
