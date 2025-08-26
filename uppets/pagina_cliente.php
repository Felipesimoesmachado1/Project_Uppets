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
    <title>UPPET - Clínica Veterinária</title>
    <link rel="stylesheet" href="css/index.css" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                UPPETS <span>Sistem</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="pagina_cliente.php">Início</a></li>
                    <li class="nav-item"><a href="agendar_consulta.php">Consultas</a></li>
                    <li class="nav-item"><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
                    <li class="nav-item"><a href="listar_pets.php">Meus Pets</a></li>
                    <li class="nav-item"><a href="historico_consulta.php">Histórico de Consultas</a></li>
                    <li class="nav-item"><a href="index.html">Sair</a></li></a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Clínica Veterinária UPPETS</h1>
                <p>Cuidando com amor e dedicação do seu melhor amigo</p>
                <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                    <a href="agendar_consulta.php" class="btn" style="background: #4ECDC4; color: white; border: none; padding: 10px 20px; border-radius: 30px; cursor: pointer; font-weight: bold; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">Agendar Consulta</a>
                    <a href="cadastrar_pet.php" class="btn" style="background: #FF6B6B; color: white; border: none; padding: 10px 20px; border-radius: 30px; cursor: pointer; font-weight: bold; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">Cadastrar Pet</a>
                    <a href="listar_pets.php" class="btn" style="background: #4ECDC4; color: white; border: none; padding: 10px 20px; border-radius: 30px; cursor: pointer; font-weight: bold; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">Meus Pets</a>
                    <a href="emergencia.html" class="btn" style="background: white; color: #4ECDC4; border: 2px solid #4ECDC4; padding: 10px 20px; border-radius: 30px; cursor: pointer; font-weight: bold; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">Emergência 24h</a>
                </div>
            </div>

            <div class="banner">
                <div class="banner-text">
                    <h2>Bem-vindo, <?php echo $_SESSION['cliente_nome']; ?>!</h2>
                    <p>Nossa clínica veterinária oferece serviços completos para cuidar da saúde e bem-estar do seu pet. Com equipamentos modernos e profissionais qualificados, proporcionamos um atendimento de excelência para garantir que seu animal de estimação receba os melhores cuidados.</p>
                    <p>Agende uma consulta hoje mesmo e conheça nossa equipe de especialistas!</p>
                </div>
                <div class="banner-image">
                    <!-- Aqui você pode adicionar uma imagem representativa -->
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <h3>Nossos Serviços</h3>
                    <p>Oferecemos uma ampla gama de serviços veterinários para garantir a saúde e bem-estar do seu pet:</p>
                    <ul>
                        <li>Consultas clínicas gerais</li>
                        <li>Vacinação e vermifugação</li>
                        <li>Cirurgias diversas</li>
                        <li>Exames laboratoriais</li>
                        <li>Radiografia e ultrassom</li>
                        <li>Internação e cuidados intensivos</li>
                        <li>Banho e tosa</li>
                        <li>Pet shop com ração e acessórios</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h3>Especialidades</h3>
                    <p>Nossa equipe é especializada em diversas áreas da medicina veterinária:</p>
                    <ul>
                        <li>Clínica de pequenos animais</li>
                        <li>Dermatologia veterinária</li>
                        <li>Cardiologia animal</li>
                        <li>Ortopedia veterinária</li>
                        <li>Odontologia pet</li>
                        <li>Oftalmologia veterinária</li>
                        <li>Medicina felina especializada</li>
                        <li>Geriatria animal</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h3>Horário de Funcionamento</h3>
                    <p>Estamos sempre prontos para atender seu pet:</p>
                    <ul>
                        <li><strong>Segunda a Sexta:</strong> 8h às 18h</li>
                        <li><strong>Sábados:</strong> 8h às 16h</li>
                        <li><strong>Domingos:</strong> 9h às 15h</li>
                        <li><strong>Emergências:</strong> 24h por dia</li>
                    </ul>
                    <p style="margin-top: 15px;"><strong>Plantão 24h disponível para emergências!</strong></p>
                </div>

                <div class="info-card">
                    <h3>Diferenciais UPPET</h3>
                    <p>O que nos torna únicos no cuidado com seu pet:</p>
                    <ul>
                        <li>Equipamentos de última geração</li>
                        <li>Veterinários especializados</li>
                        <li>Ambiente acolhedor e seguro</li>
                        <li>Atendimento humanizado</li>
                        <li>Planos de saúde para pets</li>
                        <li>Delivery de medicamentos</li>
                        <li>Acompanhamento pós-consulta</li>
                        <li>Programa de fidelidade</li>
                    </ul>
                </div>
            </div>

            <div class="contact-info">
                <h3>Entre em Contato Conosco</h3>
                <div class="contact-details">
                    <div class="contact-item">
                        <strong>📞 Telefone</strong>
                        <span>(11) 99999-9999</span>
                    </div>
                    <div class="contact-item">
                        <strong>📧 Email</strong>
                        <span>contato@uppet.com.br</span>
                    </div>
                    <div class="contact-item">
                        <strong>📍 Endereço</strong>
                        <span>Rua dos Pets, 123 - Centro</span>
                    </div>
                    <div class="contact-item">
                        <strong>🌐 WhatsApp</strong>
                        <span>(11) 98888-8888</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 40px; background-color: #f9f9f9; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h3 style="color: #4ECDC4; margin-bottom: 20px; text-align: center;">Nossa Localização</h3>
                
                <!-- Mapa real incorporado do Google Maps -->
                <div style="width: 100%; height: 300px; border-radius: 10px; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.997935951045!2d-46.65234958447503!3d-23.567270467236287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c9046a4f27%3A0xe3e3d9ea9f776c10!2sR.%20Augusta%2C%201234%20-%20Consola%C3%A7%C3%A3o%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2001305-100!5e0!3m2!1spt-BR!2sbr!4v1718210570035!5m2!1spt-BR!2sbr"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <p style="text-align: center; margin-top: 15px; color: #666;">
                    Estamos localizados em uma área de fácil acesso, com amplo estacionamento para nossos clientes.
                </p>
            </div>
        </main>
    </div>
</body>
</html>