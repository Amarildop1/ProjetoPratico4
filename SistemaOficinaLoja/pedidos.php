<?php
session_start();
require_once('db/conexao.php');
require_once('includes/header.php');

if (!isset($_SESSION['cliente_id'])) {
    echo "<p>Faça login para visualizar seus pedidos.</p>";
    require_once('includes/footer.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];

// Buscando pedidos de produtos
$sql_pedidos = "
    SELECT p.id AS pedido_id, p.data_pedido, pr.nome, pr.preco, i.quantidade
    FROM pedidos p
    JOIN itens_pedido i ON p.id = i.pedido_id
    JOIN produtos pr ON i.produto_id = pr.id
    WHERE p.cliente_id = ?
    ORDER BY p.data_pedido DESC
";
$stmt = $conexao->prepare($sql_pedidos);
$stmt->bind_param('i', $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
$pedidos = $result->fetch_all(MYSQLI_ASSOC);

// Buscando agendamentos (serviços)
$sql_servicos = "SELECT servico, data_solicitacao, mensagem FROM agendamentos WHERE id_usuario = ? ORDER BY data_solicitacao DESC";
$stmt2 = $conexao->prepare($sql_servicos);
$stmt2->bind_param('i', $cliente_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$servicos = $result2->fetch_all(MYSQLI_ASSOC);
?>

<h2>Meus Pedidos de Produtos</h2>

<?php if (count($pedidos) === 0): ?>
    <p>Você ainda não fez nenhum pedido de produto.</p>
<?php else: ?>
<table border="1" style="width:80%; margin:auto; border-collapse:collapse;">
<tr><th>Pedido</th><th>Data</th><th>Produto</th><th>Preço</th><th>Quantidade</th></tr>
<?php foreach ($pedidos as $pedido): ?>
<tr>
    <td>#<?= $pedido['pedido_id'] ?></td>
    <td><?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></td>
    <td><?= htmlspecialchars($pedido['nome']) ?></td>
    <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>
    <td><?= $pedido['quantidade'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<h2>Meus Serviços Solicitados</h2>

<?php if (count($servicos) === 0): ?>
    <p>Você ainda não solicitou serviços.</p>
<?php else: ?>
<table border="1" style="width:80%; margin:auto; border-collapse:collapse;">
<tr><th>Serviço</th><th>Data da Solicitação</th><th>Mensagem</th></tr>
<?php foreach ($servicos as $serv): ?>
<tr>
    <td><?= htmlspecialchars($serv['servico']) ?></td>
    <td><?= date('d/m/Y H:i', strtotime($serv['data_solicitacao'])) ?></td>
    <td><?= htmlspecialchars($serv['mensagem']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<?php require_once('includes/footer.php'); ?>
