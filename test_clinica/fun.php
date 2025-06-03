<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM funcionarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if ($usuario['senha'] === $senha) { // usar password_verify() com hash real
            $_SESSION["usuario"] = $usuario;
            header("Location: dashboard_funcionario.php");
            exit();
        }
    }
    echo "Email ou senha inválidos.";
}
?>

<form method="POST">
    <h2>Login Funcionário</h2>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
</form>