<?php
session_start();
if (!isset($_SESSION["funcionario_id"])) {
    header("Location: login_funcionario.php");
    exit();
}

require 'conexao.php'; // Arquivo de conexão com o banco de dados

$sql = "SELECT 
            a.id AS agendamento_id, 
            a.data_hora, 
            a.status, 
            p.nome AS pet_nome, 
            cl.nome AS cliente_nome, 
            c.descricao AS consulta_descricao, 
            c.id AS consulta_id 
        FROM agendamentos a
        JOIN pets p ON a.pet_id = p.id
        JOIN clientes cl ON p.cliente_id = cl.id
        LEFT JOIN consultas c ON a.id = c.agendamento_id
        WHERE a.status = 'realizada' OR a.status = 'pendente' 
        ORDER BY a.data_hora DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Página do Veterinário</title>
    <link rel="stylesheet" href="css/consultas.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_veterinario.php">Início</a></li>
                    <li class="nav-item"><a href="#">Consultas Agendadas</a></li>
                    <li class="nav-item"><a href="index.html">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Consultas Agendadas</h1>
                <p>Abaixo estão as consultas agendadas e realizadas:</p>
            </div>

            <table class="consulta-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Nome do Pet</th>
                        <th>Data e Hora</th>
                        <th>Status</th>
                        <th>Descrição da Consulta</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($agendamento["cliente_nome"]); ?></td>
                            <td><?php echo htmlspecialchars($agendamento["pet_nome"]); ?></td>
                            <td><?php echo htmlspecialchars($agendamento["data_hora"]); ?></td>
                            <td><?php echo htmlspecialchars($agendamento["status"]); ?></td>
                            <td><?php echo htmlspecialchars($agendamento["consulta_descricao"]); ?></td>
                            <td>
                                <?php if ($agendamento["status"] == "realizada" && empty($agendamento["consulta_descricao"])): ?>
                                    <a href="adicionar_diagnostico.php?id=<?php echo $agendamento["agendamento_id"]; ?>" class="btn">Add Diagnóstico</a>
                                <?php elseif ($agendamento["status"] == "pendente"): ?>
                                    <span>Aguardando Confirmação do Atendente</span>
                                <?php else: ?>
                                    <span><?php echo htmlspecialchars(ucfirst($agendamento["status"])); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </main>
    </div>
</body>
</html>

