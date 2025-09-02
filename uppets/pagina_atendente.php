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
    <title>UPPET - Página do Atendente</title>
    <link rel="stylesheet" href="css/consultas.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_atendente.php">Início</a></li>
                    <li class="nav-item"><a href="#">Consultas Agendadas</a></li>
                    <li class="nav-item"><a href="index.html">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Consultas Agendadas</h1>
                <p>Abaixo estão todas as consultas agendadas:</p>
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
                                <?php if ($agendamento["status"] == "pendente"): ?>
                                    <a href="confirmar_consulta.php?id=<?php echo $agendamento["agendamento_id"]; ?>" class="btn">Confirmar</a>
                                    <a href="cancelar_consulta.php?id=<?php echo $agendamento["agendamento_id"]; ?>" class="btn" style="color: red;">Cancelar</a>
                                <?php else: ?>
                                    <span><?php echo htmlspecialchars(ucfirst($agendamento["status"])); ?></span>
                                <?php endif; ?>
                                <?php if ($agendamento["status"] == "realizada" && empty($agendamento["consulta_descricao"])): ?>
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

