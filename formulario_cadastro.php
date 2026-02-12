<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

<title>Cadastro</title>

<style>

:root {
    --primary-purple: #6a0dad;
    --dark-purple: #4b0082;
    --white: #ffffff;
    --gray: #666;
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Montserrat', sans-serif;
    height:100vh;
}



.container{
    display:flex;
    height:100vh;
}


.left{
    flex:1;
    background: linear-gradient(135deg, #6a0dad, #4b0082);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:80px;
}

.left-content{
    max-width:500px;
}

.left h1{
    font-family:'Playfair Display', serif;
    font-size:3rem;
    line-height:1.2;
    margin-bottom:20px;
}

.left p{
    opacity:.9;
    font-size:1.1rem;
}


.right{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#fafafa;
}

.form-box{
    width:100%;
    max-width:420px;
}

.form-box h2{
    font-family:'Playfair Display', serif;
    font-size:2.2rem;
    margin-bottom:10px;
}

.form-box span{
    color:var(--gray);
    font-size:.95rem;
}


.input-group{
    margin-top:25px;
}

.input-group input{
    width:100%;
    padding:16px;
    border-radius:8px;
    border:1px solid #ddd;
    font-size:1rem;
    transition:.3s;
}

.input-group input:focus{
    outline:none;
    border-color:var(--primary-purple);
    box-shadow:0 0 0 3px rgba(106,13,173,.15);
}

.signup-btn{
    width:100%;
    padding:16px;
    margin-top:30px;
    border:none;
    border-radius:8px;
    background:var(--primary-purple);
    color:white;
    font-size:1rem;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.signup-btn:hover{
    background:var(--dark-purple);
    transform:translateY(-2px);
}

.login-link{
    margin-top:20px;
    text-align:center;
    font-size:.9rem;
}

.login-link a{
    color:var(--primary-purple);
    text-decoration:none;
    font-weight:600;
}

.erro-senha {
    margin-top: 8px;
    font-size: 0.85rem;
    color: red;
}

.input-error {
    border-color: red !important;
}
.senha-container{
    position: relative;
}

.toggle-senha{
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.2rem;
}

/* MUITO IMPORTANTE 👇 */
.senha-container input{
    padding-right: 45px; 
}
.senha-wrapper{
    position: relative;
}

.senha-wrapper input{
    padding-right:45px;
}

.toggle-senha{
    position:absolute;
    right:16px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
}




/* RESPONSIVO */

@media(max-width:900px){

    .left{
        display:none;
    }

    .right{
        flex:1;
        padding:40px;
    }

}

</style>

</head>
<body>

<div class="container">

    <div class="left">
        <div class="left-content">
            <h1>Venha fazer parte das amoras!</h1>
            <p>
                Junte-se a artistas que já transformam seus trabalhos artes com vida e cor!!
            </p>
        </div>
    </div>

    <div class="right">

        <div class="form-box">

            <h2>Criar conta</h2>
            <span>Leva menos de 1 minuto.</span>

            <form id="formulario01" action="processa_cadastro.php" method="POST">

                <div class="input-group">
                    <input name="nome" type="text" placeholder="Seu nome" required>
                </div>

                <div class="input-group">
                    <input name="email" type="email" placeholder="Seu melhor email" required>
                </div>

<div class="input-group senha-container">
    <input id="senha" name="senha" type="password" placeholder="Crie uma senha" required>
    <span id="toggleSenha" class="toggle-senha">👁️</span>
   
</div>
 <div id="erroSenha" class="erro-senha"></div>

                <button type="submit" class="signup-btn">
                    Criar minha conta
                </button>

            </form>

            <div class="login-link">
                Já possui conta? <a href="#">Entrar</a>
            </div>

        </div>
</div>

</div> 
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formulario01");
    const senhaInput = document.querySelector('input[name="senha"]');
    const erroSenha = document.getElementById("erroSenha");
    const toggleSenha = document.getElementById("toggleSenha");

    console.log("JS carregado");

    // Validação da senha
    form.addEventListener("submit", function (event) {
        let erros = [];
        let senha = senhaInput.value;

        if (senha.length < 8) {
            erros.push("• Deve ter no mínimo 8 caracteres");
        }
        if (!/[A-Z]/.test(senha)) {
            erros.push("• Deve conter pelo menos 1 letra maiúscula");
        }
        if (!/[0-9]/.test(senha)) {
            erros.push("• Deve conter pelo menos 1 número");
        }
        if (!/[@$!%*?&]/.test(senha)) {
            erros.push("• Deve conter pelo menos 1 caractere especial");
        }

        if (erros.length > 0) {
            event.preventDefault(); // bloqueia envio
            erroSenha.innerHTML = erros.join("<br>");
            senhaInput.classList.add("input-error");
        } else {
            erroSenha.innerHTML = "";
            senhaInput.classList.remove("input-error");
        }
    });

    // Mostrar/ocultar senha
    toggleSenha.addEventListener("click", function () {
        const tipo = senhaInput.getAttribute("type") === "password" ? "text" : "password";
        senhaInput.setAttribute("type", tipo);

        // mudar ícone do olho
        this.textContent = tipo === "password" ? "👁️" : "🙈";
    });
});
</script>



</body>
</html>
