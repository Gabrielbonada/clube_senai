<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colorista Artística | Portfolio & Cursos</title>
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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

    <main>

        <section id="home" class="hero">

            <div class="hero-content">
                <span class="hero-tag">Tratamento artístico profissional</span>

                <h2>Transforme suas ilustrações em obras memoráveis</h2>

                <p>
                    Mais cor, mais vida e um acabamento que faz sua arte ser impossível de ignorar.
                </p>

                <div class="hero-buttons">
                    <a href="#" class="primary-btn">Transformar minha ilustração</a>
                    <a href="#" class="secondary-btn">Ver resultados</a>
                </div>
            </div>
        </section>


        <section id="galeria" class="gallery-section">
            <h3 class="section-title">Galeria de Coloridos</h3>
            <div class="gallery-grid">
                <div class="gallery-item"><img src="assets/luna01.jpeg" alt="Arte 1"></div>
                <div class="gallery-item"><img src="assets/colorido01.jpeg" alt="Arte 2"></div>
                <div class="gallery-item"><img src="assets/colorido02.jpeg" alt="Arte 3"></div>
                <div class="gallery-item"><img src="assets/colorido03.jpeg" alt="Arte 4"></div>
                <div class="gallery-item"><img src="assets/colorido04.jpeg" alt="Arte 5"></div>
                <div class="gallery-item"><img src="assets/colorido05.jpeg" alt="Arte 6"></div>
                <div class="gallery-item"><img src="assets/colorido05.jpeg" alt="Arte 6"></div>
                <div class="gallery-item"><img src="assets/colorido05.jpeg" alt="Arte 6"></div>
                <div class="gallery-item"><img src="assets/colorido05.jpeg" alt="Arte 6"></div>
                <div class="gallery-item"><img src="assets/colorido05.jpeg" alt="Arte 6"></div>
            </div>
            <div class="hero-buttons">
                <a href="#" class="primary-btn">Acessar a toda galeria</a>
                <a href="#" class="primary-btn">Acessar PDFS de coloridos</a>
            </div>
        </section>

        <section id="cursos" class="courses-section">
            <h3 class="section-title">Nossos Cursos</h3>
            <div class="courses-container">
                <div class="course-card">
                    <div class="course-img" style="background-image: url(assets/banner01.jpeg)"></div>
                    <div class="course-info">
                        <h4>Paletas de cores</h4>
                        <p>Aprenda sobre todas cores de maneira profissional.</p>
                        <span class="price">R$ 000,00</span>
                        <button class="buy-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-img" style="background-image: url(assets/banner02.jpeg)">
                    </div>
                    <div class="course-info">
                        <h4>Teoria das Cores</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam nihil vel quo ab optio enim, voluptatum suscipit dolorem cumque facilis nisi dicta atque praesentium molestias ullam. Unde alias culpa placeat.</p>
                        <span class="price">R$ 000,00</span>
                        <button class="buy-btn">Comprar Agora</button>
                    </div>
                </div>
                <div class="course-card">
                    <div class="course-img" style="background-image: url(assets/colorido04.jpeg)">
                    </div>
                    <div class="course-info">
                        <h4>-------------</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid provident corrupti vero unde omnis ipsam aut quis, nesciunt facere dolore, molestiae veniam maiores illum voluptates corporis atque, iste veritatis cum.</p>
                        <span class="price">R$ 000,00</span>
                        <button class="buy-btn">Comprar Agora</button>
                    </div>
                </div>
            </div>
        </section>

        <section id="galeria" class="gallery-section">
            <h3 class="section-title">Sobre mim!</h3>
            <div id="blog" class="blog">
                <div class="content-left">
                    <img src="assets/banner01.jpeg" alt="">
                </div>
                <div class="content-right">
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur sequi facilis quibusdam
                        nesciunt provident nostrum aspernatur nobis repellat, quo hic. Labore ratione illum sit
                        doloremque quae natus, ipsa atque quos!</span>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis repudiandae odit quos
                        officia accusantium laboriosam nihil aliquam quisquam assumenda aspernatur? Eos hic molestiae
                        non nesciunt maiores sapiente ipsam minima dignissimos.</span>
                    <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda alias quos error commodi
                        eos ullam saepe totam beatae tempore doloremque eligendi autem fugiat incidunt dolor nostrum,
                        dolorum id iste asperiores?</span>
                </div>
            </div>
        </section>


    </main>


    <footer id="contato">
        <div class="footer-content">
            <p>&copy; 2026 Clube das amoras. Todos os direitos reservados.</p>
            <div class="social-links">
                <a href="https://www.instagram.com/coresemsintonia/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@coresemsintonia5325"><i class="fab fa-youtube"></i></a>
                <a href="https://pin.it/4GtJQujJQ"><i class="fab fa-pinterest"></i></a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
    </footer>

    <div id="newsletter-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <h3>Junte-se à nossa Comunidade!</h3>
                <p>Receba dicas exclusivas de colorização e novidades sobre novos cursos diretamente no seu e-mail.</p>
                <form id="newsletter-form">
                    <input type="email" placeholder="Seu melhor e-mail" required>
                    <button type="submit" class="subscribe-btn">Inscrever-se</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>