<?php
session_start();
require 'conexao.php';

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // busca usuário
    $sql = "SELECT * FROM cadastro_das_amoras WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if($user && password_verify($senha, $user['senha'])){

        // cria sessão
        $_SESSION['usuario'] = explode(" ", $user['nome'])[0];
        $_SESSION['id'] = $user['ID'];

        // manda pro sistema
        header("Location: index.php");
        exit();

    }else{
        $erro = "Email ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

<style>

:root {
    --primary-purple: #6a0dad;
    --dark-purple: #4b0082;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Montserrat', sans-serif;
    background: linear-gradient(135deg, #6a0dad, #4b0082);
}

.login-box{
    background:white;
    padding:50px;
    border-radius:12px;
    width:400px;
    box-shadow:0 20px 40px rgba(0,0,0,.2);
}

h2{
    font-family:'Playfair Display', serif;
    margin-bottom:20px;
}

input{
    width:100%;
    padding:14px;
    margin-top:15px;
    border-radius:8px;
    border:1px solid #ddd;
}

button{
    width:100%;
    padding:14px;
    margin-top:25px;
    border:none;
    border-radius:8px;
    background:var(--primary-purple);
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:var(--dark-purple);
}

.erro{
    color:red;
    margin-top:10px;
}

.cadastro{
    margin-top:20px;
    font-size:.9rem;
}

a{
    color:var(--primary-purple);
    font-weight:bold;
    text-decoration:none;
}

</style>

</head>
<body>

<div class="login-box">

    <h2>Entrar</h2>

    <?php if($erro): ?>
        <div class="erro"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Seu email" required>
        <input type="password" name="senha" placeholder="Sua senha" required>

        <button>Login</button>
    </form>

    <div class="cadastro">
        Não tem conta? <a href="formulario_cadastro.php">Criar agora</a>
    </div>

</div>

</body>
</html>
