<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login_cliente.php");
    exit();
}

require 'conexao.php';

$cliente_id = $_SESSION['cliente_id'];
$sql = "SELECT * FROM pets WHERE cliente_id = ? ORDER BY nome ASC";
$stmt = $conn->prepare($sql);
$stmt->execute([$cliente_id]);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Meus Pets</title>
    <link rel="stylesheet" href="css/consultas.css" />
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
                    <li class="nav-item"><a href="agendar_consulta.php">Consultas</a></li>
                    <li class="nav-item"><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
                    <li class="nav-item"><a href="listar_pets.php">Meus Pets</a></li>
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Meus Pets</h1>
                <p>Abaixo estão os pets cadastrados em sua conta:</p>
            </div>

            <?php if (empty($pets)): ?>
                <div class="no-pets">
                    <p>Você ainda não cadastrou nenhum pet.</p>
                    <a href="cadastrar_pet.php" class="submit-btn">Cadastrar Primeiro Pet</a>
                </div>
            <?php else: ?>
                <table class="consulta-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Raça</th>
                            <th>Tipo de Animal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pets as $pet): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pet['nome']); ?></td>
                                <td><?php echo htmlspecialchars($pet['idade']); ?> anos</td>
                                <td><?php echo htmlspecialchars($pet['raca']); ?></td>
                                <td><?php echo htmlspecialchars($pet['tipo_animal']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="actions">
                    <a href="cadastrar_pet.php" class="submit-btn">Cadastrar Novo Pet</a>
                </div>
            <?php endif; ?>

            <a href="pagina_cliente.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>

