-- Inserção de funcionários exemplo (com senha em hash)
INSERT INTO funcionarios (nome, email, senha, cargo) VALUES
('João', 'joao@clinica.com', '$2y$10$Y4ENOSZ2rr4MBz8rYgP7due5rak.6EAQAQyJZY4mljDpWKYET5vre', 'atendente'),
('Dra. Ana', 'ana@clinica.com', '$2y$10$ZfWdtwJkD/svRSLCHOXTXOV0NvUAJ7//l6OyZyeGzQFS2rxIdRTyK', 'veterinario');