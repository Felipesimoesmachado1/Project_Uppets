<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UPPET - Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/login_cliente.css" />
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <div class="logo">
                <img src="images/Captura de tela 2025-06-12 164046.png" alt="Logo UPPET" class="logo-img" />
                <h1 class="logo-title">UPPET <span>Sistem</span></h1>
                <p class="logo-subtitle">Cadastro de Cliente</p>
            </div>
        </div>

        <form id="register-form" class="register-form" method="POST" action="processar_cadastro.php">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" id="nome" name="nome" class="form-input" placeholder="Digite seu nome completo" required />
                </div>

                <div class="form-group">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-input" placeholder="000.000.000-00" required />
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required />
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" class="form-input" placeholder="(00) 00000-0000" required />
                </div>

                <div class="form-group">
                    <label for="nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" id="nascimento" name="nascimento" class="form-input" required />
                </div>
            </div>

            <div class="form-group">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-input" placeholder="Rua, número, complemento" required />
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Crie uma senha forte" required />
                </div>

                <div class="form-group">
                    <label for="confirm-password" class="form-label">Confirmar Senha</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Repita sua senha" required />
                </div>
            </div>

            <div class="form-group terms-group">
                <input type="checkbox" id="terms" name="terms" class="checkbox-input" required />
                <label for="terms" class="checkbox-label">Li e aceito os <a href="#" class="terms-link">Termos de Uso</a> e <a href="#" class="terms-link">Política de Privacidade</a></label>
            </div>

            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>

        <div class="footer-links">
            <a href="index.php" class="footer-link">Voltar ao site principal</a>
            <span class="link-separator">|</span>
            <a href="login_cliente.php" class="footer-link accent-link">Já tem conta? Faça login</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
