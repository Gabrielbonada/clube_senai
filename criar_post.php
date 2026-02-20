<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    die("Acesso negado 🚫");
}

if (isset($_POST['criar'])) {

    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $imagem = $_POST['imagem'];
    $autor = $_SESSION['usuario'];

    $stmt = $pdo->prepare("
        INSERT INTO posts (titulo, conteudo, imagem, autor)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$titulo, $conteudo, $imagem, $autor]);

    echo "Post criado com sucesso 😎";
}
?>