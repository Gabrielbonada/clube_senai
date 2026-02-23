<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    die("Acesso negado");
}

$titulo = $_POST['titulo'];
$conteudo1 = $_POST['conteudo1'];
$conteudo2 = $_POST['conteudo2'];
$conteudo3 = $_POST['conteudo3'];
$conteudo4 = $_POST['conteudo4'];
$conteudo5 = $_POST['conteudo5'];
$imagem = $_POST['imagem'];
$autor = $_SESSION['usuario'];
$categoria = $_POST['categoria'];

$stmt = $pdo->prepare("
    INSERT INTO posts 
    (titulo, conteudo1, conteudo2, conteudo3, conteudo4, conteudo5, imagem, autor, categoria)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $titulo,
    $conteudo1,
    $conteudo2,
    $conteudo3,
    $conteudo4,
    $conteudo5,
    $imagem,
    $autor,
    $categoria
]);

header("Location: blog.php");
exit();