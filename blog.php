<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Blog | Clube das Amoras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <script src="script.js"></script>

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
            <li><a href="index.php#home">Início</a></li>
            <li><a href="index.php#galeria">Galeria</a></li>
            <li><a href="index.php#cursos">Cursos</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="index.php#contato">Contato</a></li>

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

        <!-- CATEGORIAS -->
        <section class="blog-categories">
            <div class="categories-container">
                <span class="category active">Todos</span>
                <span class="category">Ilustração</span>
                <span class="category">Técnicas</span>
                <span class="category">Cores</span>
                <span class="category">Dicas</span>
            </div>
        </section>

        <!-- POST PRINCIPAL -->
        <section class="blog-post">
            <div class="blog-container">

                <h2 class="blog-title">Como Escolher a Paleta Perfeita para Sua Ilustração</h2>

                <p class="blog-meta">
                    Publicado por <?= $_SESSION['usuario'] ?? 'Clube das Amoras' ?> • 12 Fevereiro 2026
                </p>

                <img src="assets/banner01.jpeg" class="blog-image" alt="">

                <div class="blog-content">
                    <p>
                        A escolha da paleta de cores é uma das decisões mais importantes
                        na construção de uma ilustração marcante.
                    </p>

                    <p>
                        Quando você entende contraste, temperatura e harmonia,
                        suas artes ganham profundidade e identidade.
                    </p>

                    <p>
                        Neste artigo vou te mostrar como pensar cores de forma estratégica
                        e emocional.
                    </p>
                </div>

            </div>
        </section>

        <!-- AUTOR -->
        <section class="author-section">
            <div class="author-box">
                <img src="https://i.pravatar.cc/100?img=68" alt="">
                <div>
                    <h4>Clube das Amoras</h4>
                    <p>
                        Escola especializada em cursos de desenho artístico e digital.
                        Nosso objetivo é ajudar artistas iniciantes e intermediários
                        a evoluírem suas técnicas.
                    </p>
                </div>
            </div>
        </section>

        <!-- POSTS RELACIONADOS -->
        <section class="related-posts">
            <h3 class="section-title">Você também pode gostar</h3>

            <div class="related-container">

                <div class="related-card">
                    <img src="assets/banner02.jpeg" alt="">
                    <h4>5 Técnicas de Sombreamento</h4>
                </div>

                <div class="related-card">
                    <img src="assets/banner03.jpeg" alt="">
                    <h4>Como Criar Personagens Memoráveis</h4>
                </div>

                <div class="related-card">
                    <img src="assets/banner01.jpeg" alt="">
                    <h4>Introdução à Psicologia das Cores</h4>
                </div>

            </div>
        </section>

        <!-- COMENTÁRIOS -->
        <section class="testimonials-section">
            <h3 class="section-title">Comentários dos Leitores</h3>
            <div class="testimonials-container">
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                    <p class="testimonial-text"> "Explicação incrível! Consegui aplicar tudo na minha arte no mesmo dia." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=12" alt="">
                        <div> <strong>Bernardo Lima</strong> <span>Designer</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i> </div>
                    <p class="testimonial-text"> "Muito claro e direto, adorei a parte sobre contraste." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=22" alt="">
                        <div> <strong>Juliana Costa</strong> <span>Ilustradora</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                    <p class="testimonial-text"> "Já quero mais conteúdos assim no blog!" </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=33" alt="">
                        <div> <strong>Carlos Duarte</strong> <span>Leitor</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                    <p class="testimonial-text"> "Esse blog está ficando cada vez mais profissional." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=44" alt="">
                        <div> <strong>Fernanda Alves</strong> <span>Artista Digital</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i> </div>
                    <p class="testimonial-text"> "Adorei a identidade visual do site também." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=55" alt="">
                        <div> <strong>Luan Mendes</strong> <span>UX Designer</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                    <p class="testimonial-text"> "Simplesmente perfeito! Continue postando." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=66" alt="">
                        <div> <strong>Irael Rocha</strong> <span>Estudante</span> </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating"> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="fas fa-star"></i> </div>
                    <p class="testimonial-text"> "Esse tipo de conteúdo é ouro para quem está começando." </p>
                    <div class="testimonial-author"> <img src="https://i.pravatar.cc/100?img=15" alt="">
                        <div> <strong>Letícia Ramos</strong> <span>Iniciante em Ilustração</span> </div>
                    </div>
                </div>
        </section>

    </main>

    <footer>
        <p style="text-align:center; padding:40px;">
            © 2026 Clube das Amoras
        </p>
    </footer>

</body>

</html>