<?php
session_start();
var_dump($_SESSION);
?>
<?php
session_start();
require 'conexao.php';

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
if (isset($_POST['criar_post']) && $_SESSION['tipo'] === 'admin') {

    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $imagem = $_POST['imagem'];
    $autor = $_SESSION['usuario'];

    $stmt = $pdo->prepare("
        INSERT INTO posts (titulo, conteudo, imagem, autor)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([$titulo, $conteudo, $imagem, $autor]);

    header("Location: blog.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Blog | Clube das Amoras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="blog.css">
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
        <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
<section class="admin-create-post">
    <h3>📝 Criar Novo Blog</h3>

    <form method="POST" class="create-post-form">
        <input type="text" name="titulo" placeholder="Título" required>

        <input type="text" name="imagem" placeholder="URL da imagem">

        <textarea name="conteudo" placeholder="Conteúdo do blog..." required></textarea>

        <button type="submit" name="criar_post">Publicar Blog</button>
    </form>
</section>
<?php endif; ?>

        <!-- POST PRINCIPAL -->
      <section class="blog-post">
<div class="blog-container">

<?php
$result = $pdo->query("SELECT * FROM posts ORDER BY data_post DESC");

while ($post = $result->fetch(PDO::FETCH_ASSOC)):
?>

<h2 class="blog-title"><?= htmlspecialchars($post['titulo']) ?></h2>

<p class="blog-meta">
Publicado por <?= htmlspecialchars($post['autor']) ?> • <?= date('d/m/Y', strtotime($post['data_post'])) ?>
</p>

<img src="<?= $post['imagem'] ?>" class="blog-image">

<div class="blog-content">
<p><?= nl2br(htmlspecialchars($post['conteudo'])) ?></p>
</div>

<hr>

<?php endwhile; ?>

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

        <section class="comment-form-section">
    <h3 class="section-title">Deixe seu comentário</h3>

    <form method="POST" class="comment-form">
        

        <input type="text" name="cargo" placeholder="Profissão (opcional)">

        <textarea name="mensagem" placeholder="Escreva seu comentário..." required></textarea>

        <select name="avaliacao">
            <option value="5">★★★★★</option>
            <option value="4">★★★★☆</option>
            <option value="3">★★★☆☆</option>
            <option value="2">★★☆☆☆</option>
            <option value="1">★☆☆☆☆</option>
        </select>

        <button type="submit" name="enviar_comentario">Publicar</button>
    </form>
</section>

        <!-- COMENTÁRIOS -->
        <section class="testimonials-section">
            <h3 class="section-title">Comentários dos Leitores</h3>
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
        <img src="https://i.pravatar.cc/100?u=<?= urlencode($row['nome']); ?>" alt="">
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

    <footer>
        <p style="text-align:center; padding:40px;">
            © 2026 Clube das Amoras
        </p>
    </footer>

</body>

</html>