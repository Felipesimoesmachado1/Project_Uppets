<?php
require 'conexao.php';
session_start();

if (!isset($conn) || $conn === null) {
    die("Erro: Conexão com o banco de dados não estabelecida.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_SESSION['cliente_id'];
    $pet_nome = $_POST['pet_nome'];
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $descricao = $_POST['descricao'];

    // 1. Buscar o pet_id com base no nome do pet e cliente_id
    $sql_pet = "SELECT id FROM pets WHERE nome = ? AND cliente_id = ?";
    $stmt_pet = $conn->prepare($sql_pet);
    $stmt_pet->execute([$pet_nome, $cliente_id]);
    $pet = $stmt_pet->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "Erro: Pet não encontrado para este cliente.";
        exit();
    }
    $pet_id = $pet['id'];

    // 2. Combinar data e hora para o campo data_hora da tabela agendamentos
    $data_hora_agendamento = $data_consulta . ' ' . $hora_consulta . ':00';

    // 3. Inserir na tabela agendamentos
    // Por enquanto, usaremos IDs de atendente e veterinário fixos (ou você pode adicionar campos no formulário)
    // Você precisará definir como esses IDs serão obtidos (ex: seleção no formulário, atribuição automática)
    $atendente_id = 1; // Exemplo: ID de um atendente existente
    $veterinario_id = 1; // Exemplo: ID de um veterinário existente

    $sql_agendamento = "INSERT INTO agendamentos (pet_id, atendente_id, veterinario_id, data_hora, status) VALUES (?, ?, ?, ?, ?)";
    $stmt_agendamento = $conn->prepare($sql_agendamento);

    if ($stmt_agendamento->execute([$pet_id, $atendente_id, $veterinario_id, $data_hora_agendamento, 'pendente'])) {
        header("Location: pagina_cliente.php"); // Redirecionar após o agendamento
        exit();
    } else {
        echo "Erro ao agendar consulta: " . $stmt_agendamento->errorInfo()[2];
    }
}
?>

