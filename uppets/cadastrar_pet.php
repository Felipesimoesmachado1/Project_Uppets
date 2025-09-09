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
    <title>UPPET - Cadastrar Pet</title>
    <link rel="stylesheet" href="css/consultas.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_cliente.php">Início</a></li>
                    <li class="nav-item"><a href="agendar_consulta.php">Consultas</a></li>
                    <li class="nav-item"><a href="listar_pets.php">Meus pets</a></li>
                     <li class="nav-item"><a href="historico_consulta.php">Historico de consultas</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Cadastrar Pet</h1>
                <p>Preencha os dados abaixo para cadastrar seu pet no sistema.</p>
            </div>

            <form action="processar_cadastro_pet.php" method="POST" class="agendamento-form">
                <div class="form-group">
                    <label for="nome">Nome do Pet:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="idade">Idade (em anos):</label>
                    <input type="number" id="idade" name="idade" min="0" max="30" required>
                </div>

                <div class="form-group">
                    <label for="raca">Raça:</label>
                    <input type="text" id="raca" name="raca" placeholder="Ex: Labrador, Persa, etc.">
                </div>

                <div class="form-group">
                    <label for="tipo_animal">Tipo de Animal:</label>
                    <select id="tipo_animal" name="tipo_animal" required>
                        <option value="">Selecione o tipo</option>
                        <option value="Cão">Cão</option>
                        <option value="Gato">Gato</option>
                        <option value="Pássaro">Pássaro</option>
                        <option value="Coelho">Coelho</option>
                        <option value="Hamster">Hamster</option>
                        <option value="Peixe">Peixe</option>
                        <option value="Réptil">Réptil</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Cadastrar Pet</button>
            </form>

        </main>
    </div>
</body>
</html>

