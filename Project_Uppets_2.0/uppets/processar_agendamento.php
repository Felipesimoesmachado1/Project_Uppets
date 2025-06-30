<?php
require 'conexao.php'; // Arquivo de conexão com o banco de dados
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_SESSION['cliente_id'];
    $pet_nome = $_POST['pet_nome'];
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO consultas (cliente_id, pet_nome, data_consulta, hora_consulta, descricao) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $cliente_id, $pet_nome, $data_consulta, $hora_consulta, $descricao);

    if ($stmt->execute()) {
        header("Location: pagina_cliente.php"); // Redirecionar após o agendamento
        exit();
    } else {
        echo "Erro ao agendar consulta: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
