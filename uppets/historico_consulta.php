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
    <link rel="stylesheet" href="css/index.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
           
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_cliente.php">Início</a></li>
                    <li class="nav-item"><a href="consultas.php">Agendar Consulta</a></li>
                    <li class="nav-item"><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
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
                    <a href="consultas.php" class="submit-btn">Agendar sua primeira consulta</a>
                </div>
            <?php else: ?>
                <div class="consultas-container">
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <div class="consulta-card">
                            <div class="consulta-header">
                                <h3><?php echo htmlspecialchars($agendamento["pet_nome"]); ?></h3>
                                <span class="status-badge status-<?php echo strtolower($agendamento["status"]); ?>">
                                    <?php echo htmlspecialchars(ucfirst($agendamento["status"])); ?>
                                </span>
                            </div>
                            
                            <div class="consulta-info">
                                <div class="info-row">
                                    <strong>Pet:</strong> 
                                    <?php echo htmlspecialchars($agendamento["pet_nome"]); ?> 
                                    (<?php echo htmlspecialchars($agendamento["pet_tipo_animal"]); ?> - <?php echo htmlspecialchars($agendamento["pet_raca"]); ?>)
                                </div>
                                <div class="info-row">
                                    <strong>Data e Hora:</strong> 
                                    <?php echo htmlspecialchars(date("d/m/Y H:i", strtotime($agendamento["data_hora"]))); ?>
                                </div>
                                <div class="info-row">
                                    <strong>Veterinário:</strong> 
                                    <?php echo htmlspecialchars($agendamento["veterinario_nome"] ?: "Não Atribuído"); ?>
                                </div>
                            </div>

                            <?php if (!empty($agendamento["consulta_descricao"])): ?>
                                <div class="consulta-descricao">
                                    <h4>Descrição da Consulta:</h4>
                                    <p><?php echo htmlspecialchars($agendamento["consulta_descricao"]); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($agendamento["consulta_diagnostico"])): ?>
                                <div class="consulta-diagnostico">
                                    <h4>Diagnóstico do Veterinário:</h4>
                                    <p><?php echo htmlspecialchars($agendamento["consulta_diagnostico"]); ?></p>
                                </div>
                            <?php elseif ($agendamento["status"] == "realizada"): ?>
                                <div class="consulta-diagnostico-pendente">
                                    <p><em>Aguardando diagnóstico do veterinário...</em></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="actions">
                <a href="pagina_cliente.php" class="btn btn-secondary">Voltar para a Página Inicial</a>
            </div>
        </main>
    </div>

    <style>
        .consultas-container {
            display: grid;
            gap: 20px;
            margin: 20px 0;
        }

        .consulta-card {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .consulta-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .consulta-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .consulta-header h3 {
            color: #4ECDC4;
            font-size: 22px;
            margin: 0;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pendente {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-realizada {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelada {
            background-color: #f8d7da;
            color: #721c24;
        }

        .consulta-info {
            margin-bottom: 20px;
        }

        .info-row {
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 1.5;
        }

        .info-row strong {
            color: #333;
            display: inline-block;
            min-width: 120px;
        }

        .consulta-descricao,
        .consulta-diagnostico {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .consulta-descricao h4,
        .consulta-diagnostico h4 {
            color: #4ECDC4;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .consulta-descricao p,
        .consulta-diagnostico p {
            color: #555;
            line-height: 1.6;
            margin: 0;
        }

        .consulta-diagnostico {
            background-color: #e8f5e8;
            border-left: 4px solid #28a745;
        }

        .consulta-diagnostico-pendente {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
            margin-bottom: 15px;
        }

        .consulta-diagnostico-pendente p {
            color: #856404;
            margin: 0;
            font-style: italic;
        }

        .no-consultas {
            text-align: center;
            padding: 60px 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .no-consultas p {
            color: #6c757d;
            font-size: 18px;
            margin-bottom: 25px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4ECDC4, #44A08D);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
        }

        .actions {
            text-align: center;
            margin-top: 40px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .consulta-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .info-row strong {
                min-width: auto;
                display: block;
                margin-bottom: 5px;
            }

            .consulta-card {
                padding: 20px;
            }
        }
    </style>
</body>
</html>