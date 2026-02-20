<?php
$imagens = glob("*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Artes</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins:wght@300;400&display=swap" rel="stylesheet">

    <style>
        /* BODY ROXO ESCURO */
        body {
            margin: 0;
            background: #1a032b;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        /* HEADER SUPERIOR */
        header {
            background: #120020;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #2e0a47;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }

        .logo span {
            color: #c084fc;
            font-style: italic;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            margin-left: 25px;
            font-size: 14px;
            transition: 0.3s;
        }

        .menu a:hover {
            color: #c084fc;
        }

        /* TÍTULO */
        .titulo {
            text-align: center;
            padding: 50px 20px 30px;
        }

        .titulo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            margin: 0;
        }

        .linha {
            width: 80px;
            height: 3px;
            background: #c084fc;
            margin: 15px auto;
        }

        /* GALERIA PRETA */
        .galeria-container {
            background: #000;
            padding: 60px 80px;
        }

        .galeria {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .item {
            overflow: hidden;
            border-radius: 10px;
        }

        .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s ease;
            cursor: pointer;
        }

        .item:hover img {
            transform: scale(1.08);
        }

        /* FOOTER */
        footer {
            background: #120020;
            text-align: center;
            padding: 30px 20px;
            font-size: 14px;
            border-top: 1px solid #2e0a47;
        }

        footer span {
            color: #c084fc;
            font-weight: 500;
        }

        /* RESPONSIVO */
        @media (max-width: 768px) {

            header {
                padding: 20px;
                flex-direction: column;
                gap: 10px;
            }

            .galeria-container {
                padding: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
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

    <nav id="sidebar" class="sidebar">
        <button id="close-sidebar" class="close-btn">&times;</button>
        <ul class="nav-links">
            <li><a href="#home">Início</a></li>
            <li><a href="#galeria">Galeria de Coloridos</a></li>
            <li><a href="#cursos">Produtos & Cursos</a></li>
            <li><a href="#blog">Blog</a></li>
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

    <!-- TÍTULO -->
    <section class="titulo">
        <h1>Galeria de Artes</h1>
        <div class="linha"></div>
    </section>

    <!-- GALERIA -->
    <section class="galeria-container">
        <div class="galeria">
            <?php if ($imagens): ?>
                <?php foreach ($imagens as $img): ?>
                    <div class="item">
                        <img src="<?php echo $img; ?>" alt="">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>

                <section id="galeria" class="gallery-section">

                    <div class="gallery-grid">
                        <div class="gallery-item"><img src="galeria/media1.jpeg" alt="Arte 1"></div>
                        <div class="gallery-item"><img src="galeria/media4.jpeg" alt="Arte 2"></div>
                        <div class="gallery-item"><img src="galeria/media3.jpeg" alt="Arte 3"></div>
                        <div class="gallery-item"><img src="galeria/media 2.jpeg" alt="Arte 4"></div>
                        <div class="gallery-item"><img src="galeria/media5.jpeg" alt="Arte 5"></div>
                        <div class="gallery-item"><img src="galeria/media6.jpeg" alt="Arte 6"></div>
                        <div class="gallery-item"><img src="galeria/media7.jpeg" alt="Arte 7"></div>
                        <div class="gallery-item"><img src="galeria/media8.jpeg" alt="Arte 8"></div>
                        <div class="gallery-item"><img src="galeria/media9.jpeg" alt="Arte 9"></div>
                        <div class="gallery-item"><img src="galeria/media10.jpeg" alt="Arte 10"></div>
                        <div class="gallery-item"><img src="galeria/media11.jpeg" alt="Arte 11"></div>
                        <div class="gallery-item"><img src="galeria/media12.jpeg" alt="Arte 12"></div>
                        <div class="gallery-item"><img src="galeria/media13.jpeg" alt="Arte 13"></div>
                        <div class="gallery-item"><img src="galeria/media14.jpeg" alt="Arte 14"></div>
                        <div class="gallery-item"><img src="galeria/media15.jpeg" alt="Arte 15"></div>
                        <div class="gallery-item"><img src="galeria/media1.jpeg" alt="Arte 16"></div>
                        <div class="gallery-item"><img src="galeria/media18.jpeg" alt="Arte 17"></div>
                        <div class="gallery-item"><img src="galeria/media19.jpeg" alt="Arte 18"></div>
                        <div class="gallery-item"><img src="galeria/media20.jpeg" alt="Arte 19"></div>
                        <div class="gallery-item"><img src="galeria/media21.jpeg" alt="Arte 20"></div>
                        <div class="gallery-item"><img src="galeria/media22.jpeg" alt="Arte 21"></div>
                        <div class="gallery-item"><img src="galeria/media23.jpeg" alt="Arte 22"></div>
                        <div class="gallery-item"><img src="galeria/media24.jpeg" alt="Arte 23"></div>
                        <div class="gallery-item"><img src="galeria/media25.jpeg" alt="Arte 24"></div>
                        <div class="gallery-item"><img src="galeria/media26.jpeg" alt="Arte 25"></div>
                        <div class="gallery-item"><img src="galeria/media27.jpeg" alt="Arte 26"></div>
                        <div class="gallery-item"><img src="galeria/media28.jpeg" alt="Arte 27"></div>
                        <div class="gallery-item"><img src="galeria/media29.jpeg" alt="Arte 28"></div>
                        <div class="gallery-item"><img src="galeria/media30.jpeg" alt="Arte 29"></div>
                    </div>

        </div>
    </section>
<?php endif; ?>
</div>
</section>

<!-- FOOTER -->
<footer>
    © <?php echo date("Y"); ?> <span>Clube das Artes</span> • Todos os direitos reservados
    <br>
    Desenvolvido com criatividade 🎨
</footer>
<script src="script.js"></script>

</body>

</html>