<?php
require 'conexao.php'; 
session_start();

if (isset($_GET['id'])) {
    $agendamento_id = $_GET['id']; 
    
    // Atualiza o status na tabela agendamentos
    $sql = "UPDATE agendamentos SET status = 'cancelada' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$agendamento_id])) {
        header("Location: pagina_atendente.php"); // Redirecionar após o cancelamento
        exit();
    } else {
        echo "Erro ao cancelar agendamento: " . $stmt->errorInfo()[2];
    }
}
?>

