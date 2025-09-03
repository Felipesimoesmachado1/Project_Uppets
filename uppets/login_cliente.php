<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UPPET - Login do Cliente</title>
    <link rel="stylesheet" href="css/login_cliente.css" />
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo" role="banner" aria-label="Logo UPPET">
                <img src="images/Captura de tela 2025-06-12 164046.png" alt="Logo UPPET" class="logo-img" />
                
            </div>
        </div>

        <form id="login-form" class="login-form" method="POST" action="processar_login_cliente.php">
            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" id="email" name="email" class="form-input" placeholder="Digite seu e-mail" required autocomplete="username" />
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Digite sua senha" required autocomplete="current-password" />
            </div>

            <div class="login-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" class="checkbox-input" />
                    <label for="remember" class="checkbox-label">Lembrar-me</label>
                </div>
                <div class="forgot-password">
                    <a href="#" class="forgot-link">Esqueci minha senha</a>
                </div>
            </div>

            <button type="submit" class="submit-btn">Entrar</button>
        </form>

        <div class="footer-links">
            <a href="index.html" class="footer-link">Voltar ao site principal</a>
            <span class="link-separator">|</span>
            <a href="cadastrar_cliente.php" class="footer-link accent-link">Não tem conta? Cadastre-se</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>