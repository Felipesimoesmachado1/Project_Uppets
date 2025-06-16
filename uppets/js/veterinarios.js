document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    // Simulação de autenticação (em um sistema real, isso seria feito no servidor)
    if (username === 'vet' && password === 'admin') {
        localStorage.setItem('vet_logged_in', 'true');
        window.location.href = 'dashboard.html';
    } else {
        alert('Usuário ou senha incorretos!');
    }
});