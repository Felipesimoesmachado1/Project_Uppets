<?php
// processar_login_cliente.php
require 'conexao.php'; // Arquivo de conexão com o banco de dados

session_start(); // Iniciar a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        // Verificar a senha
        if (password_verify($senha, $cliente['senha'])) {
            // Senha correta, iniciar sessão
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['cliente_nome'] = $cliente['nome'];
            header("Location: pagina_cliente.php"); // Redirecionar para a página do cliente
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Não encontramos um cliente com esse e-mail.";
    }

    
}

?>