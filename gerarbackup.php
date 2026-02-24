<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    die("Acesso negado");
}

// cria pasta se não existir
$pasta = "backups";
if(!is_dir($pasta)){
    mkdir($pasta, 0755, true);
}

// pega dados
$usuarios = $pdo->query("SELECT * FROM cadastro_das_amoras")->fetchAll(PDO::FETCH_ASSOC);
$posts = $pdo->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);

// cria nome com data
$data = date("Y-m-d_H-i-s");

file_put_contents("backups/usuarios_$data.json", json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents("backups/posts_$data.json", json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Backup criado com sucesso! 🎉 <br><a href='admin.php'>Voltar</a>";
?>