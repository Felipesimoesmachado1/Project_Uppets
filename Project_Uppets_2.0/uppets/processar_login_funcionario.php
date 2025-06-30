<?php
// processar_login_funcionario.php
require 'conexao.php'; // Arquivo de conexão com o banco de dados

session_start(); // Iniciar a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM funcionarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();
        // Verificar a senha
        if (password_verify($senha, $funcionario['senha'])) {
            // Senha correta, iniciar sessão
            $_SESSION['funcionario_id'] = $funcionario['id'];
            $_SESSION['funcionario_nome'] = $funcionario['nome'];
            header("Location: pagina_atendente.php"); // Redirecionar para a página do atendente
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Não encontramos um funcionário com esse e-mail.";
    }

    $stmt->close();
}
$conn->close();
?>
