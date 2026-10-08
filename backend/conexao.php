<?php
$host = 'mysql-local';   // nome do Service no Kubernetes
$user = 'myuser';
$pass = 'mypassword';
$db   = 'mydatabase';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");