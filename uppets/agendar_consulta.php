<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header("Location: login_cliente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPET - Agendar Consulta</title>
    <link rel="stylesheet" href="css/consultas.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
            

        <main class="main-content">
            <div class="header">
                <h1>Agendar Consulta</h1>
                <p>Preencha os dados abaixo para agendar uma consulta para seu pet.</p>
            </div>

            <form action="processar_agendamento.php" method="POST" class="agendamento-form">
                <div class="form-group">
                    <label for="pet_nome">Nome do Pet:</label>
                    <input type="text" id="pet_nome" name="pet_nome" required>
                </div>

                <div class="form-group">
                    <label for="data_consulta">Data da Consulta:</label>
                    <input type="date" id="data_consulta" name="data_consulta" required>
                </div>

                <div class="form-group">
                    <label for="hora_consulta">Hora da Consulta:</label>
                    <input type="time" id="hora_consulta" name="hora_consulta" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição do Problema:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Agendar Consulta</button>
            </form>

            <a href="pagina_cliente.php">Voltar para a Página Inicial</a>
        </main>
    </div>
</body>
</html>