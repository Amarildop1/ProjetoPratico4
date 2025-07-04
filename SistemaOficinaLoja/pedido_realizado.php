<?php
session_start();
require_once('db/conexao.php');

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

if (empty($_SESSION['carrinho'])) {
    echo "Carrinho vazio.";
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$data_pedido = date('Y-m-d H:i:s');

// Inserindo pedido
$stmt = $conexao->prepare("INSERT INTO pedidos (cliente_id, data_pedido) VALUES (?, ?)");
$stmt->bind_param('is', $cliente_id, $data_pedido);
if (!$stmt->execute()) {
    echo "Erro ao criar pedido.";
    exit;
}
$pedido_id = $stmt->insert_id;

// Inserindo itens do pedido
$stmt_item = $conexao->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)");

foreach ($_SESSION['carrinho'] as $item) {
    $stmt_item->bind_param('iii', $pedido_id, $item['id'], $item['quantidade']);
    $stmt_item->execute();
}

unset($_SESSION['carrinho']);

header('Location: pedidos.php');
exit;
