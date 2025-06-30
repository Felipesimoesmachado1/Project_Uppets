<?php
// processar_cadastro.php
require 'conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha

    $sql = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        header("Location: login_cliente.php"); // Redirecionar após o cadastro
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>