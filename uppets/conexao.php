<?php
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'uppet';
$user = 'root'; // usuário do banco de dados
$pass = ''; // senha do banco de dados

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
