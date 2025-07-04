<?php
session_start();

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $encontrado = false;

    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['id'] === $id) {
            $item['quantidade']++;
            $encontrado = true;
            break;
        }
    }
    if (!$encontrado) {
        $_SESSION['carrinho'][] = ['id' => $id, 'quantidade' => 1];
    }
}

header('Location: finalizar-pedido.php');
exit;
