<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>Motos e Motores</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <header>
            <div class="logo">
                <img src="imagens/logo.jpg" alt="Logo Motos e Motores" height="80">
            </div>

            <button id="btn-menu" class="btn-menu" aria-label="Abrir menu">&#9776;</button>

            <nav>
                <ul id="menu-lista">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li><a href="servicos.php">Serviços</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <?php if (isset($_SESSION['cliente_id'])): ?>
                        <li><a href="pedidos.php">Meus Pedidos</a></li>
                        <li><a href="carrinho.php">Carrinho</a></li>
                        <li><a href="logout.php">Sair</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="cadastro.php">Cadastro</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

    <main>
