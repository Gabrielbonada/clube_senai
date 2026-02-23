<?php
session_start();
require 'conexao.php';

// Verifica se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$id = $_GET['id'];

// Busca o post no banco
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar o post
if (!$post) {
    echo "Post não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['titulo']) ?></title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Clube Das<span> Amoras</span></h1>
        </div>
        <button id="menu-toggle" class="menu-btn">
            <span class="menu-text">menu</span>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
    </header>

    <!-- componente de sidebar com sistema de cadastro por php  -->
    <nav id="sidebar" class="sidebar">
        <button id="close-sidebar" class="close-btn">&times;</button>
        <ul class="nav-links">
            <li><a href="#home">Início</a></li>
            <li><a href="#galeria">Galeria de Coloridos</a></li>
            <li><a href="#cursos">Produtos & Cursos</a></li>
            <li><a href="#about-me">Blog & sobre mim</a></li>
            <li><a href="#clube_das_amoras">Clube das amoras</a></li>
            <li><a href="#contato">Contatos</a></li>
            <?php if (!isset($_SESSION['usuario'])): ?>

                <li class="login-item">
                    <a href="login.php">
                        <i class="fas fa-user"></i> Login
                    </a>
                </li>

                <li class="cadastro-item">
                    <a href="formulario_cadastro.php">
                        <i class="fa-solid fa-address-card"></i> Cadastro
                    </a>
                </li>

            <?php else: ?>

                <li class="login-item">
                    <a href="#">
                        <i class="fas fa-user"></i> <?= $_SESSION['usuario']; ?>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </li>

            <?php endif; ?>

        </ul>
    </nav>

    <h1 class="title-post"><?= htmlspecialchars($post['titulo']) ?></h1>
    <div class="linha-decorativa"></div>
    <main class="post-container">

        <div class="post-image">
            <img src="<?= htmlspecialchars($post['imagem']) ?>" alt="">
        </div>

        <div class="post-content">
            <?= nl2br(htmlspecialchars($post['conteudo1'])) ?>
            <?= nl2br(htmlspecialchars($post['conteudo2'])) ?>
            <?= nl2br(htmlspecialchars($post['conteudo3'])) ?>

        </div>
    </main>


     <div class="post-content">
            <?= nl2br(htmlspecialchars($post['conteudo4'])) ?>
            <?= nl2br(htmlspecialchars($post['conteudo5'])) ?>
        </div>
    <div class="post-footer">
        <a href="blog.php" class="btn-voltar">← Voltar para o Blog</a>
    </div>

    <script src="script.js"></script>

</body>

</html>