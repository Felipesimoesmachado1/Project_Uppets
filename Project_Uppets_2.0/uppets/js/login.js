document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');
    const userOptions = document.querySelectorAll('.user-option');
    const passwordField = document.getElementById('password');
    const usernameField = document.getElementById('username');
    
    // User type selection
    let selectedUserType = 'atendente'; // Default to atendente
    
    userOptions.forEach(option => {
        option.addEventListener('click', function() {
            userOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            selectedUserType = this.getAttribute('data-user-type');
        });
    });
    
    // Show/hide password functionality
    const togglePassword = document.getElementById('toggle-password');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? 'ðŸ‘ï¸' : 'ðŸ‘ï¸â€ðŸ—¨ï¸';
        });
    }
    
    // Form submission
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error message
            errorMessage.style.display = 'none';
            
            const username = usernameField.value.trim();
            const password = passwordField.value.trim();
            
            // Basic validation
            if (!username || !password) {
                errorMessage.textContent = 'Por favor, preencha todos os campos.';
                errorMessage.style.display = 'block';
                return;
            }
            
            // Simulate authentication (in a real app, this would be a backend API call)
            simulateLogin(username, password, selectedUserType);
        });
    }
    
    function simulateLogin(username, password, userType) {
        // This is just a simulation - in a real application this would be a backend API call
        
        // For demo purposes, we'll accept any credentials with some basic validation
        if (password.length < 4) {
            errorMessage.textContent = 'Senha muito curta. Use pelo menos 4 caracteres.';
            errorMessage.style.display = 'block';
            return;
        }
        
        // Simulate a network request
        errorMessage.textContent = 'Autenticando...';
        errorMessage.style.display = 'block';
        errorMessage.style.color = '#4ECDC4';
        
        setTimeout(() => {
            // Redirect based on user type
            if (userType === 'atendente') {
                window.location.href = 'dashboard-atendente.html';
            } else if (userType === 'veterinario') {
                window.location.href = 'dashboard-veterinario.html';
            } else {
                // Default fallback
                errorMessage.textContent = 'Tipo de usuÃ¡rio invÃ¡lido.';
                errorMessage.style.display = 'block';
                errorMessage.style.color = '#e74c3c';
            }
        }, 1500);
    }
});