<?php
require 'conexao.php'; // Arquivo de conexão com o banco de dados
session_start();

if (!isset($_SESSION['funcionario_id']) || !isset($_GET['id'])) {
    header("Location: login_funcionario.php");
    exit();
}

$consulta_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnostico = $_POST['diagnostico'];

    $sql = "UPDATE consultas SET diagnostico = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$diagnostico, $consulta_id])) {
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
                    <li class="nav-item"><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Adicionar Diagnóstico</h1>
                <p>Preencha os dados abaixo para adicionar um diagnóstico à consulta.</p>
            </div>

            <form action="" method="POST" class="diagnostico-form">
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico:</label>
                    <textarea id="diagnostico" name="diagnostico" rows="4" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Adicionar Diagnóstico</button>
            </form>

            <a href="pagina_veterinario.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>

