<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UPPET - Login do Funcionário</title>
    <link rel="stylesheet" href="css/login_funcionario.css" />
</head>
<body>
    <div class="login-container">
        <div class="logo" role="banner" aria-label="Logo UPPET">
            <img src="images/Captura de tela 2025-06-12 164046.png" alt="Logo UPPET" />
            <h1>UPPET <span>Sistem</span></h1>
            <p>Sistema de Gerenciamento Veterinário</p>
        </div>

        <form id="login-form" class="login-form" method="POST" action="processar_login_funcionario.php">
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" placeholder="Digite seu usuário" required autocomplete="username" />
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required autocomplete="current-password" />
            </div>

            <div id="error-message" class="error-message" role="alert" aria-live="assertive"></div>

            <button type="submit" class="submit-btn">Entrar</button>
        </form>

        <div class="back-to-site">
            <a href="index.html">Voltar ao site principal</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

