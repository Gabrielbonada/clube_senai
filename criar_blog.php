<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
    header("Location: blog.php");
    exit();
}

require 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Blog | Clube das Amoras</title>

    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="criacao_blog.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="create-post-container">

    <h1>Criar Novo Post </h1>
    <p class="subtitle">Compartilhe suas ideias com o Clube das Amoras</p>

    <form method="POST" action="salvar_novo_blog.php" class="create-form">

        <input type="text" name="titulo" placeholder="Título do post" required>

        <select name="categoria" required>
            <option value="">Escolha categoria</option>
            <option>Ilustração</option>
            <option>Técnicas</option>
            <option>Cores</option>
            <option>Dicas</option>
        </select>

        <input type="text" name="imagem" placeholder="URL da imagem">

        <textarea name="conteudo1" placeholder="Escreva o conteúdo do post..." required></textarea>
        <textarea name="conteudo2" placeholder="Escreva o conteúdo do post..." required></textarea>
        <textarea name="conteudo3" placeholder="Escreva o conteúdo do post..." required></textarea>
        <textarea name="conteudo4" placeholder="Escreva o conteúdo do post..." required></textarea>
        <textarea name="conteudo5" placeholder="Escreva o conteúdo do post..." required></textarea>

        <button type="submit">Publicar Post 💜</button>

    </form>

</div>

</body>
</html>