<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login_cliente.php");
    exit();
}

require 'conexao.php'; // Arquivo de conexão com o banco de dados

$cliente_id = $_SESSION['cliente_id'];
$sql = "SELECT * FROM consultas WHERE cliente_id = ? ORDER BY data_consulta DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Histórico de Consultas</title>
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
                    <li class="nav-item"><a href="pagina_cliente.php">Início</a></li>
                    <li class="nav-item"><a href="veterinarios.html">Veterinários</a></li>
                    <li class="nav-item"><a href="emergencia.html">Emergência</a></li>
                    <li class="nav-item"><a href="consultas.php">Consultas</a></li>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Histórico de Consultas</h1>
                <p>Abaixo estão suas consultas agendadas:</p>
            </div>

            <table class="consulta-table">
                <thead>
                    <tr>
                        <th>Nome do Pet</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['pet_nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['data_consulta']); ?></td>
                            <td><?php echo htmlspecialchars($row['hora_consulta']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="pagina_cliente.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
