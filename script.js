document.addEventListener('DOMContentLoaded', () => {
    // --- Menu Lateral (Sidebar) ---
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const navLinks = document.querySelectorAll('.nav-links a');
    

    menuToggle.addEventListener('click', () => {
        sidebar.classList.add('active');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });

    // Fechar sidebar ao clicar em um link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    });

    // --- Modal de Newsletter ---
    const modal = document.getElementById('newsletter-modal');
    const closeModal = document.querySelector('.close-modal');
    const newsletterForm = document.getElementById('newsletter-form');

    // Abrir modal após 5 segundos
    setTimeout(() => {
        if (!localStorage.getItem('newsletterShown')) {
            modal.style.display = 'block';
        }
    }, 5000);

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        localStorage.setItem('newsletterShown', 'true');
    });

    // Fechar modal ao clicar fora dele
    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
            localStorage.setItem('newsletterShown', 'true');
        }
    });

    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = newsletterForm.querySelector('input').value;
        alert(`Obrigado! O e-mail ${email} foi cadastrado com sucesso.`);
        modal.style.display = 'none';
        localStorage.setItem('newsletterShown', 'true');
    });

    // --- Efeito de Scroll Suave ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // --- Animação Simples ao Scroll ---
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.gallery-item, .course-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
});

