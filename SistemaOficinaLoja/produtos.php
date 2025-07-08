<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<?php 
    include('includes/header.php');
?>

<?php
    include('db/conexao.php');


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
        $produto_id = (int)$_POST['produto_id'];
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        if (!in_array($produto_id, $_SESSION['carrinho'])) {
            $_SESSION['carrinho'][] = $produto_id;
            $msg = "Produto adicionado ao carrinho!";
        } else {
            $msg = "Produto já está no carrinho.";
        }
    }


    // Se usuário NÃO está logado, salva a página atual para redirecionar depois
    if (!isset($_SESSION['cliente_id'])) {
        // Salva a URL atual (produtos.php)
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    }

?>


<h1 class="titulo-center">Nossos Produtos</h1>

<?php if (isset($msg)): ?>
    <p style="color: green; text-align: center;"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<?php
    $linhas = ["Motor", "Suspensão", "Freio", "Elétrica", "Carenagem"];
    foreach ($linhas as $linha) {
        echo "<h2>Peças de $linha</h2> <div class='produtos'>";
        
        $query = "SELECT * FROM produtos WHERE linha = '$linha' LIMIT 5";
        $resultado = mysqli_query($conexao, $query);
        
        while ($produto = mysqli_fetch_assoc($resultado)) {
            echo "
                    <div class='card'>
                        <h3>{$produto['nome']}</h3>
                        <p>{$produto['descricao']}</p>
                        <p><strong>R$ {$produto['preco']}</strong></p>";
                
                if (isset($_SESSION['cliente_id'])) {
                    echo "
                        <form method='POST' action='carrinho.php'>
                            <input type='hidden' name='acao' value='adicionar'>
                            <input type='hidden' name='id' value='{$produto['id']}'>
                            <input type='hidden' name='nome' value='" . htmlspecialchars($produto['nome']) . "'>
                            <input type='hidden' name='preco' value='{$produto['preco']}'>
                            <input type='hidden' name='quantidade' value='1'>
                            <input type='submit' value='Adicionar ao Carrinho'>
                        </form>";
                } else {
                    echo "<p style='color: red;'>Faça <a href='login.php' style='font-weight: 700;'>login</a> para adicionar ao carrinho.</p>";
                }

                echo "</div>";
        } /* Final while */
        
        echo "</div>";
    } /* Final foreach */
?>


<?php include('includes/footer.php'); ?>

