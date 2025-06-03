<?php
$host = 'localhost';
$db = 'uppet';
$user = 'root';
$pass = ''; // ou sua senha do MySQL

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>