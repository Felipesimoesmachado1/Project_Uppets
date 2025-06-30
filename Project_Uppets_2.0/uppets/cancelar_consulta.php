<?php
require 'conexao.php'; // Arquivo de conexão com o banco de dados
session_start();

if (isset($_GET['id'])) {
    $consulta_id = $_GET['id'];

    $sql = "DELETE FROM consultas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $consulta_id);

    if ($stmt->execute()) {
        header("Location: pagina_atendente.php"); // Redirecionar após o cancelamento
        exit();
    } else {
        echo "Erro ao cancelar consulta: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
