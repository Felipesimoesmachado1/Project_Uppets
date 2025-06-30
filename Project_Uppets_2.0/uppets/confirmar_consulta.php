<?php
require 'conexao.php'; // Arquivo de conexão com o banco de dados
session_start();

if (isset($_GET['id'])) {
    $consulta_id = $_GET['id'];

    $sql = "UPDATE consultas SET status = 'confirmada' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $consulta_id);

    if ($stmt->execute()) {
        header("Location: pagina_atendente.php"); // Redirecionar após a confirmação
        exit();
    } else {
        echo "Erro ao confirmar consulta: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>