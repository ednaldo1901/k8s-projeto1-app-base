<?php
header('Content-Type: application/json; charset=utf-8');
require 'conexao.php';

$method = $_SERVER['REQUEST_METHOD'];

// POST → insere nova mensagem
if ($method === 'POST') {
    $nome     = $_POST['nome']     ?? '';
    $email    = $_POST['email']    ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    if (empty($nome) || empty($email) || empty($mensagem)) {
        http_response_code(400);
        echo json_encode(['erro' => 'Preencha todos os campos.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO mensagem (nome, email, mensagem) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $mensagem);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['ok' => true, 'id' => $conn->insert_id]);
    exit;
}

// GET → retorna lista de mensagens
if ($method === 'GET') {
    $result = $conn->query("SELECT id, nome, email, mensagem FROM mensagem ORDER BY id DESC");
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);
    exit;
}

// Outros métodos
http_response_code(405);
echo json_encode(['erro' => 'Método não permitido.']);

