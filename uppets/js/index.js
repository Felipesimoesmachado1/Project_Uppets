
// Scroll suave para âncoras internas
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Botão: Agendar Consulta
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', () => {
        const text = button.textContent.trim();
        if (text === 'Agendar Consulta') {
            alert('Redirecionando para agendamento de consulta...');
            // Aqui você pode redirecionar se quiser: window.location.href = 'consultas.html';
        } else if (text === 'Emergência 24h') {
            alert('Entre em contato imediato: (11) 98888-8888');
        }
    });
});

// Alerta simples quando clicar no item "Contato"
const contatoLink = document.querySelector('a[href="#contato"]');
if (contatoLink) {
    contatoLink.addEventListener('click', () => {
        alert('Role até o final da página para ver os contatos e localização.');
    });
}
