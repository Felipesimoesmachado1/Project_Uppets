
<?php
require 'conexao.php'; 
session_start();

if (!isset($_SESSION['funcionario_id']) || !isset($_GET['id'])) {
    header("Location: login_funcionario.php");
    exit();
}

$agendamento_id = $_GET['id'];

// Buscar informações do agendamento
$sql_agendamento = "SELECT a.*, p.nome AS pet_nome, cl.nome AS cliente_nome 
                    FROM agendamentos a
                    JOIN pets p ON a.pet_id = p.id
                    JOIN clientes cl ON p.cliente_id = cl.id
                    WHERE a.id = ?";
$stmt_agendamento = $conn->prepare($sql_agendamento);
$stmt_agendamento->execute([$agendamento_id]);
$agendamento = $stmt_agendamento->fetch(PDO::FETCH_ASSOC);

if (!$agendamento) {
    echo "Agendamento não encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnostico = $_POST['diagnostico'];
    $descricao = $_POST['descricao'];

    // Inserir novo registro na tabela consultas
    $sql = "INSERT INTO consultas (agendamento_id, descricao, data_consulta, diagnostico) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$agendamento_id, $descricao, $agendamento['data_hora'], $diagnostico])) {
        header("Location: pagina_veterinario.php"); // Redirecionar após adicionar diagnóstico
        exit();
    } else {
        echo "Erro ao adicionar diagnóstico: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Adicionar Diagnóstico</title>
    <link rel="stylesheet" href="css/diagnostico.css"/>
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        

        <main class="main-content">
            <div class="header">
                <h1>Adicionar Diagnóstico</h1>
            </div>

            <div class="consulta-info">
                <h3>Informações da Consulta</h3>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($agendamento['cliente_nome']); ?></p>
                <p><strong>Pet:</strong> <?php echo htmlspecialchars($agendamento['pet_nome']); ?></p>
                <p><strong>Data/Hora:</strong> <?php echo htmlspecialchars($agendamento['data_hora']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($agendamento['status']); ?></p>
            </div>

            <form action="" method="POST" class="diagnostico-form">
                <div class="form-group">
                    <label for="descricao">Descrição da Consulta:</label>
                    <textarea id="descricao" name="descricao" rows="3" required placeholder="Descreva o que foi observado durante a consulta..."></textarea>
                </div>

                <div class="form-group">
                    <label for="diagnostico">Diagnóstico:</label>
                    <textarea id="diagnostico" name="diagnostico" rows="4" required placeholder="Digite o diagnóstico detalhado..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Adicionar Diagnóstico</button>
            </form>

            <a href="pagina_veterinario.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>

