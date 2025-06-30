document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar
    const toggleSidebar = document.querySelector('.toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');
    
    if (toggleSidebar && sidebar) {
        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Update toggle icon
            const toggleIcon = this.querySelector('.toggle-icon');
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.innerHTML = '&#10095;'; // Right arrow
            } else {
                toggleIcon.innerHTML = '&#10094;'; // Left arrow
            }
        });
    }
    
    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        
        const icon = type === 'success' ? '✔️' : '❌';
        
        notification.innerHTML = `
            <div class="notification-icon">${icon}</div>
            <div class="notification-message">${message}</div>
            <button class="notification-close">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        // Show notification (animation)
        setTimeout(() => {
            notification.classList.add('active');
        }, 10);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // Close button
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.addEventListener('click', function() {
            hideNotification(notification);
        });
    }
    
    function hideNotification(notification) {
        notification.classList.remove('active');
        setTimeout(() => notification.remove(), 300);
    }
    
    // Modal interactions
    const modalOverlay = document.querySelector('.modal-overlay');
    const openModalBtn = document.querySelector('.open-modal');
    const closeModalBtn = document.querySelector('.close-modal');
    
    if (modalOverlay && openModalBtn && closeModalBtn) {
        openModalBtn.addEventListener('click', () => {
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        modalOverlay.addEventListener('click', e => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('search-input');
    const dataTable = document.querySelector('.data-table');
    
    if (searchInput && dataTable) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = dataTable.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
    
    // Handle form submission (consulta-form)
    const consultaForm = document.getElementById('consulta-form');
    
    if (consultaForm) {
        consultaForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const consultaData = {};
            
            formData.forEach((value, key) => {
                consultaData[key] = value;
            });
            
            console.log('Consulta data:', consultaData);
            
            showNotification('Consulta salva com sucesso!');
            if (modalOverlay) {
                modalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            this.reset();
            addConsultaRow(consultaData);
        });
    }
    
    // Add new row in consultas table
    function addConsultaRow(data) {
        const tbody = document.querySelector('.data-table tbody');
        if (!tbody) return;
        
        const now = new Date();
        const id = now.getTime();
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>#${id.toString().slice(-5)}</td>
            <td>${data.pet_name}</td>
            <td>${data.owner_name}</td>
            <td>${data.date} ${data.time}</td>
            <td><span class="status pending">Pendente</span></td>
            <td>
                <div class="action-icons">
                    <div class="action-icon view-icon">👁️</div>
                    <div class="action-icon edit-icon">✏️</div>
                    <div class="action-icon delete-icon">🗑️</div>
                </div>
            </td>
        `;
        
        tbody.prepend(row);
        setupActionIcons(row);
    }
    
    // Setup action icons event listeners
    function setupActionIcons(container = document) {
        container.querySelectorAll('.view-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.cells[0].textContent;
                const pet = row.cells[1].textContent;
                showNotification(`Visualizando consulta ${id} para ${pet}`);
                // Aqui abrir modal de visualização etc.
            });
        });
        
        container.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.cells[0].textContent;
                const pet = row.cells[1].textContent;
                showNotification(`Editando consulta ${id} para ${pet}`);
                if (modalOverlay) {
                    modalOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    // Popular form para edição aqui
                }
            });
        });
        
        container.querySelectorAll('.delete-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = row.cells[0].textContent;
                const pet = row.cells[1].textContent;
                if (confirm(`Deseja realmente excluir a consulta ${id} para ${pet}?`)) {
                    row.remove();
                    showNotification(`Consulta ${id} excluída com sucesso!`, 'error');
                }
            });
        });
    }
    
    // Inicializa icons já existentes
    setupActionIcons();
    
    // Logout button
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', () => {
            if (confirm('Deseja realmente sair?')) {
                window.location.href = 'login.html';
            }
        });
    }
    
    // Login form submit (fora do logout)
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('error-message');
            
            if (username === 'atendente' && password === 'atende123') {
                window.location.href = 'pagina_atendente.html';
                return;
            }
            
            if (username === 'admin' && password === '123') {
                window.location.href = 'pagina_atendente.html';
                return;
            }
            
            errorDiv.textContent = 'Usuário ou senha incorretos.';
            errorDiv.style.color = 'red';
        });
    }
});
