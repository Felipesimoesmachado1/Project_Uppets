<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $pet_nome = $_POST["pet_nome"];
    $pet_idade = $_POST["pet_idade"];
    $raca = $_POST["raca"];
    $tipo_animal = $_POST["tipo_animal"];

    // 1. Criar cliente
    $sql = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha); // use hash no real
    $stmt->execute();
    $cliente_id = $stmt->insert_id;

    // 2. Criar pet
    $sql_pet = "INSERT INTO pets (nome, idade, raca, tipo_animal, cliente_id) VALUES (?, ?, ?, ?, ?)";
    $stmt_pet = $conn->prepare($sql_pet);
    $stmt_pet->bind_param("sissi", $pet_nome, $pet_idade, $raca, $tipo_animal, $cliente_id);
    $stmt_pet->execute();

    echo "Cadastro realizado com sucesso!";
}
?>

<form method="POST">
    <h2>Cadastro Cliente</h2>
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br><br>

    <h3>Informações do Pet</h3>
    Nome: <input type="text" name="pet_nome"><br>
    Idade: <input type="number" name="pet_idade"><br>
    Raça: <input type="text" name="raca"><br>
    Tipo de Animal: <input type="text" name="tipo_animal"><br>
    <button type="submit">Cadastrar</button>
</form>