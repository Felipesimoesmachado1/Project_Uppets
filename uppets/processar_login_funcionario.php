<?php
// processar_login_funcionario.php
require 'conexao.php'; // Conexão com o banco de dados

session_start(); // Iniciar a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos foram preenchidos
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $senha = $_POST['password'];

        // Buscar funcionário pelo e-mail
        $sql = "SELECT * FROM funcionarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            // Verificar a senha
            if (password_verify($senha, $funcionario['senha'])) {
                // Senha correta, iniciar sessão
                $_SESSION['funcionario_id'] = $funcionario['id'];
                $_SESSION['funcionario_nome'] = $funcionario['nome'];
                $_SESSION['funcionario_cargo'] = $funcionario['cargo'];

                // Redirecionar com base no cargo
                if ($funcionario['cargo'] === 'veterinario') {
                    header("Location: pagina_veterinario.php");
                } elseif ($funcionario['cargo'] === 'atendente') {
                    header("Location: pagina_atendente.php");
                } else {
                    // Cargo inválido no banco
                    echo "Cargo do funcionário não reconhecido.";
                }
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Funcionário não encontrado com esse e-mail.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

