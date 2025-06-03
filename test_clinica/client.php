<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($cliente = $resultado->fetch_assoc()) {
        if ($cliente['senha'] === $senha) {
            $_SESSION["cliente"] = $cliente;
            header("Location: dashboard_cliente.php");
            exit();
        }
    }
    echo "Email ou senha inválidos.";
}
?>

<form method="POST">
    <h2>Login Cliente</h2>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
</form>