<?php
session_start();
if (!isset($_SESSION['funcionario_id'])) {
    header("Location: login_funcionario.php");
    exit();
}

require 'conexao.php'; // Arquivo de conexão com o banco de dados

$sql = "SELECT c.*, cl.nome AS cliente_nome FROM consultas c JOIN clientes cl ON c.cliente_id = cl.id WHERE c.status = 'confirmada' ORDER BY c.data_consulta DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Página do Veterinário</title>
    <link rel="stylesheet" href="css/index.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="images/Captura de tela 2025-06-12 164046.png" alt="">
                UPPETS <span>Sistem</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_veterinario.php">Início</a></li>
                    <li class="nav-item"><a href="historico_consultas.php">Histórico de Consultas</a></li>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Consultas Confirmadas</h1>
                <p>Abaixo estão as consultas confirmadas:</p>
            </div>

            <table class="consulta-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Nome do Pet</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['cliente_nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['pet_nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['data_consulta']); ?></td>
                            <td><?php echo htmlspecialchars($row['hora_consulta']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                            <td>
                                <a href="adicionar_diagnostico.php?id=<?php echo $row['id']; ?>" class="btn">Adicionar Diagnóstico</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="logout.php">Sair</a>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
