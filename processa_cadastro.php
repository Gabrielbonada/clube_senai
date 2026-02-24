<?php
require 'conexao.php';

// pega os dados
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// 🔎 VERIFICAR EMAIL
$check = $pdo->prepare("SELECT id FROM cadastro_das_amoras WHERE email = ?");
$check->execute([$email]);

if($check->rowCount() > 0){
    die("Email já cadastrado!");
}

// ✅ INSERT
$sql = "INSERT INTO cadastro_das_amoras (nome, email, senha, tipo)
        VALUES (?, ?, ?, 'user')";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $senhaHash]);


// ⭐ BACKUP AUTOMÁTICO AQUI ⭐

// cria pasta se não existir
$pasta = "backups";
if(!is_dir($pasta)){
    mkdir($pasta, 0755, true);
}

// pega todos usuários
$stmt = $pdo->query("SELECT * FROM cadastro_das_amoras");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// salva arquivo
file_put_contents(
    "backups/usuarios_backup.json",
    json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);


// redireciona
header("Location: login.php");
exit();
?>