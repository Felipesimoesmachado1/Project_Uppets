<?php
require 'conexao.php';
session_start();

if (!isset($conn) || $conn === null) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}

if (!isset($_SESSION['cliente_id'])) {
    header("Location: login_cliente.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_SESSION['cliente_id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $raca = $_POST['raca'];
    $tipo_animal = $_POST['tipo_animal'];

    $sql = "INSERT INTO pets (nome, idade, raca, tipo_animal, cliente_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$nome, $idade, $raca, $tipo_animal, $cliente_id])) {
        echo "<script>alert('Pet cadastrado com sucesso!'); window.location.href='pagina_cliente.php';</script>";
        exit();
    } else {
        echo "Erro ao cadastrar pet: " . $stmt->errorInfo()[2];
    }
}
?>

