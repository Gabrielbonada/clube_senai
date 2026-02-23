<?php
session_start();

require 'conexao.php';

// Processar envio de comentário
if (isset($_POST['enviar_comentario'])) {
    $nome = $_SESSION['usuario'] ?? 'Anônimo';
    $cargo = !empty($_POST['cargo']) ? $_POST['cargo'] : 'Leitor';
    $mensagem = $_POST['mensagem'];
    $avaliacao = $_POST['avaliacao'];

    $stmt = $pdo->prepare("
        INSERT INTO comentarios (nome, cargo, mensagem, avaliacao)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$nome, $cargo, $mensagem, $avaliacao]);

    header("Location: blog.php");
    exit();
}

// Processar criação de novo post (apenas admin)
if (isset($_POST['criar_post']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $imagem = $_POST['imagem'];
    $categoria = $_POST['categoria'] ?? 'Dicas';
    $autor = $_SESSION['usuario'];

    $stmt = $pdo->prepare("
        INSERT INTO posts (titulo, conteudo, imagem, categoria, autor)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([$titulo, $conteudo, $imagem, $categoria, $autor]);

    header("Location: blog.php");
    exit();
}

// Obter categoria do filtro
$categoria = $_GET['categoria'] ?? 'Todos';

// Buscar posts com filtro de categoria
if ($categoria == "Todos") {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY data_post DESC");
} else {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE categoria = ? ORDER BY data_post DESC");
    $stmt->execute([$categoria]);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Blog | Clube das Amoras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <script src="script.js"></script>

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

    <!-- NAVEGAÇÃO SIDEBAR -->
    <nav id="sidebar" class="sidebar">
        <button id="close-sidebar" class="close-btn">&times;</button>

        <ul class="nav-links">
            <li><a href="index.php#home">Início</a></li>
            <li><a href="index.php#galeria">Galeria</a></li>
            <li><a href="index.php#cursos">Cursos</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="index.php#contato">Contato</a></li>

            <!-- SEÇÃO DE USUÁRIO: Login/Cadastro ou Usuário Logado -->
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
                        <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['usuario']); ?>
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


        <!-- SEÇÃO DE CATEGORIAS COM FILTRO FUNCIONAL -->
        <section class="blog-categories">
            <div class="categories-container">
                <a href="blog.php?categoria=Todos" class="category <?= $categoria == 'Todos' ? 'active' : '' ?>">
                    Todos
                </a>

                <a href="blog.php?categoria=Ilustração" class="category <?= $categoria == 'Ilustração' ? 'active' : '' ?>">
                    Ilustração
                </a>

                <a href="blog.php?categoria=Técnicas" class="category <?= $categoria == 'Técnicas' ? 'active' : '' ?>">
                    Técnicas
                </a>

                <a href="blog.php?categoria=Cores" class="category <?= $categoria == 'Cores' ? 'active' : '' ?>">
                    Cores
                </a>

                <a href="blog.php?categoria=Dicas" class="category <?= $categoria == 'Dicas' ? 'active' : '' ?>">
                    Dicas
                </a>
            </div>
        </section>


        <!-- SEÇÃO DE POSTS PRINCIPAIS COM FILTRO APLICADO -->
        <section class="blog-post">
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <div class="blog-card">
                        <img src="<?= htmlspecialchars($post['imagem']) ?>">
                        <div class="blog-card-content">
                            <h3><?= htmlspecialchars($post['titulo']) ?></h3>
                            <p><?= substr(strip_tags($post['conteudo1']), 0, 120) ?>...</p>
                            <a href="post.php?id=<?= $post['id'] ?>" class="btn-blog">Ler mais</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
            <a href="criar_blog.php" class="btn-admin">
                ➕ Criar Novo Blog
            </a>
        <?php endif; ?>

     

        <!-- SEÇÃO DE FORMULÁRIO DE COMENTÁRIO -->
        <section class="comment-form-section">
            <h3 class="section-title">Deixe seu comentário</h3>

            <form method="POST" class="comment-form">
                <input type="text" name="cargo" placeholder="Profissão (opcional)">

                <textarea name="mensagem" placeholder="Escreva seu comentário..." required></textarea>

                <select name="avaliacao" required>
                    <option value="">Selecione uma avaliação</option>
                    <option value="5">★★★★★ Excelente</option>
                    <option value="4">★★★★☆ Muito Bom</option>
                    <option value="3">★★★☆☆ Bom</option>
                    <option value="2">★★☆☆☆ Regular</option>
                    <option value="1">★☆☆☆☆ Ruim</option>
                </select>

                <button type="submit" name="enviar_comentario">Publicar Comentário</button>
            </form>
        </section>

        <!-- SEÇÃO DE COMENTÁRIOS DOS LEITORES -->
        <section class="testimonials-section">
            <h3 style="text-align: center;" class="section-title">Comentários dos Leitores</h3>
            <div class="testimonials-container">
                <?php
                $result = $pdo->query("SELECT * FROM comentarios ORDER BY data_comentario DESC");

                while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                ?>

                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $row['avaliacao']) {
                                    echo '<i class="fas fa-star"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </div>

                        <p class="testimonial-text">
                            "<?= htmlspecialchars($row['mensagem']); ?>"
                        </p>

                        <div class="testimonial-author">
                            <img src="https://i.pravatar.cc/100?u=<?= urlencode($row['nome']); ?>" alt="<?= htmlspecialchars($row['nome']); ?>">
                            <div>
                                <strong><?= htmlspecialchars($row['nome']); ?></strong>
                                <span><?= htmlspecialchars($row['cargo']); ?></span>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
     <!-- fotter com redes sociais  -->
    <footer id="contato">
        <div class="footer-content">
            <p>&copy; 2026 Clube das amoras. Todos os direitos reservados.</p>
            <div class="social-links">
                <a href="https://www.instagram.com/coresemsintonia/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/@coresemsintonia5325"><i class="fab fa-youtube"></i></a>
                <a href="https://pin.it/4GtJQujJQ"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </footer>

    <!-- Botão WhatsApp Flutuante -->
    <a href="https://wa.me/5551985462737" target="_blank" class="whatsapp-btn" title="Envie uma mensagem no WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- SCRIPT PARA FUNCIONALIDADES DO MENU MOBILE -->
    <script>
        // Controlar abertura e fechamento do menu hambúrguer
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('menu-toggle');
            sidebar.classList.toggle('active');
            btn.classList.toggle('active');
        });

        // Fechar sidebar ao clicar no botão de fechar
        document.getElementById('close-sidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('menu-toggle');
            sidebar.classList.remove('active');
            btn.classList.remove('active');
        });

        // Fechar sidebar ao clicar em um link de navegação
        document.querySelectorAll('.sidebar .nav-links a').forEach(link => {
            link.addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                const btn = document.getElementById('menu-toggle');
                sidebar.classList.remove('active');
                btn.classList.remove('active');
            });
        });
    </script>

</body>

</html>