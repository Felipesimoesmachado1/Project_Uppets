<?php
session_start();
if (!isset($_SESSION["cliente_id"])) {
    header("Location: login_cliente.php");
    exit();
}

require 'conexao.php'; // Arquivo de conexão com o banco de dados

$cliente_id = $_SESSION["cliente_id"];

$sql = "SELECT 
            a.id AS agendamento_id, 
            a.data_hora, 
            a.status, 
            p.nome AS pet_nome, 
            p.raca AS pet_raca, 
            p.tipo_animal AS pet_tipo_animal, 
            c.descricao AS consulta_descricao, 
            c.diagnostico AS consulta_diagnostico, 
            f.nome AS veterinario_nome 
        FROM agendamentos a
        JOIN pets p ON a.pet_id = p.id
        JOIN clientes cl ON p.cliente_id = cl.id
        LEFT JOIN consultas c ON a.id = c.agendamento_id
        LEFT JOIN funcionarios f ON a.veterinario_id = f.id
        WHERE cl.id = ? 
        ORDER BY a.data_hora DESC";

$stmt = $conn->prepare($sql);
$stmt->execute([$cliente_id]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Histórico de Consultas</title>
    <link rel="stylesheet" href="css/consultas.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
              
                <img src="images/" alt="">
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_cliente.php">Início</a></li>
                    <li class="nav-item"><a href="emergencia.html">Emergência</a></li>
                    <li class="nav-item"><a href="agendar_consulta.php">Agendar Consulta</a></li>
                    <li class="nav-item"><a href="listar_pets.php">Meus Pets</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Histórico de Consultas</h1>
                <p>Abaixo estão suas consultas agendadas e realizadas:</p>
            </div>

            <?php if (empty($agendamentos)): ?>
                <div class="no-consultas">
                    <p>Você ainda não possui consultas agendadas ou realizadas.</p>
                    <a href="agendar_consulta.php" class="submit-btn">Agendar sua primeira consulta</a>
                </div>
            <?php else: ?>
                <table class="consulta-table">
                    <thead>
                        <tr>
                            <th>Pet</th>
                            <th>Data e Hora</th>
                            <th>Status</th>
                            <th>Veterinário</th>
                            <th>Descrição do Agendamento</th>
                            <th>Diagnóstico (Veterinário)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agendamentos as $agendamento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($agendamento["pet_nome"]); ?> (<?php echo htmlspecialchars($agendamento["pet_tipo_animal"]); ?> - <?php echo htmlspecialchars($agendamento["pet_raca"]); ?>)</td>
                                <td><?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($agendamento["data_hora"]))); ?></td>
                                <td><?php echo htmlspecialchars(ucfirst($agendamento["status"])); ?></td>
                                <td><?php echo htmlspecialchars($agendamento["veterinario_nome"] ?: "Não Atribuído"); ?></td>
                                <td><?php echo htmlspecialchars($agendamento["consulta_descricao"] ?: "N/A"); ?></td>
                                <td><?php echo htmlspecialchars($agendamento["consulta_diagnostico"] ?: "Aguardando Diagnóstico"); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <a href="pagina_cliente.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>

