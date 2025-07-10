<?php
    session_start();
    require_once('db/conexao.php');
    require_once('includes/header.php');

    if (!isset($_SESSION['cliente_id'])) {
        echo "<p>Faça login para visualizar o carrinho.</p>";
        require_once('includes/footer.php');
        exit;
    }

    if (empty($_SESSION['carrinho'])) {
        echo "<p style='text-align: center;'>Seu carrinho está vazio.</p>";
        require_once('includes/footer.php');
        exit;
    }

    $carrinho = $_SESSION['carrinho'];
    $ids = array_column($carrinho, 'id');

    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT id, nome, preco FROM produtos WHERE id IN ($placeholders)";
    $stmt = $conexao->prepare($sql);

    $types = str_repeat('i', count($ids));
    $stmt->bind_param($types, ...$ids);
    $stmt->execute();
    $result = $stmt->get_result();

    $produtos = [];
    while ($row = $result->fetch_assoc()) {
        $produtos[$row['id']] = $row;
    }
?>


    <h2 class="titulo-center">Seu Carrinho</h2>
    <table border="1" style="width:80%; margin:auto; border-collapse:collapse;">
        <tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Total</th></tr>

        <?php
            $totalGeral = 0;
            foreach ($carrinho as $item):
                $produto = $produtos[$item['id']];
                $subtotal = $item['quantidade'] * $produto['preco'];
                $totalGeral += $subtotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($produto['nome']) ?></td>
            <td><?= $item['quantidade'] ?></td>
            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="3" style="text-align:right;">Total Geral:</th>
            <th>R$ <?= number_format($totalGeral, 2, ',', '.') ?></th>
        </tr>
    </table>

    <form method="post" action="pedido_realizado.php" style="text-align:center; margin-top:20px;">
        <button type="submit" class="btn-finalizarPedido">Finalizar Pedido</button>
    </form>

<?php require_once('includes/footer.php'); ?>

