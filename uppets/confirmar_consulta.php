<?php
require 'conexao.php'; // Arquivo de conexão com o banco de dados
session_start();

if (isset($_GET['id'])) {
    $consulta_id = $_GET['id'];

    $sql = "UPDATE agendamentos SET status = 'realizada' WHERE id = ?"; // Alterado para agendamentos
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$consulta_id])) {
        // Opcional: Inserir na tabela consultas se a agendamento foi realizada
        // $sql_insert_consulta = "INSERT INTO consultas (agendamento_id, descricao, data_consulta) VALUES (?, ?, ?)";
        // $stmt_insert_consulta = $conn->prepare($sql_insert_consulta);
        // $stmt_insert_consulta->execute([$consulta_id, 'Consulta realizada', date('Y-m-d H:i:s')]);

        header("Location: pagina_atendente.php"); // Redirecionar após a confirmação
        exit();
    } else {
        echo "Erro ao confirmar agendamento: " . $stmt->errorInfo()[2];
    }
}
?>

