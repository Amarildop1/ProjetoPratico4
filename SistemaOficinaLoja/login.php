<?php
    session_start();
    include('db/conexao.php');
    mysqli_set_charset($conexao, "utf8mb4");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'];

        if (!$email) {
            $erro = "Email inválido.";
        } else {
            $stmt = $conexao->prepare("SELECT id, nome, senha FROM clientes WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows === 1) {
                $cliente = $resultado->fetch_assoc();
                if (password_verify($senha, $cliente['senha'])) {
                    $_SESSION['cliente_id'] = $cliente['id'];
                    $_SESSION['cliente_nome'] = $cliente['nome'];

                    // Redirecionamento personalizado
                    if (isset($_SESSION['redirect_after_login'])) {
                        $redirect_url = $_SESSION['redirect_after_login'];
                        unset($_SESSION['redirect_after_login']);
                        header("Location: $redirect_url");
                        exit();
                    }
                    // Se não existir URL salva, redireciona para pedidos.php
                    header('Location: pedidos.php');
                    exit();
                }
            }
            $erro = "Email ou senha incorretos.";
        }
    }
?>


<?php include('includes/header.php'); ?>

    <h1 class="titulo-center">Login do Cliente</h1>

    <form method="POST" action="login.php" class="form-login">
        <label>Nome:</label>
        <input type="email" name="email" placeholder="Digite seu e-mail aqui..." required autofocus/>
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha aqui" required />
        <input type="submit" value="Entrar" />
    </form>

    <?php if (isset($erro)) echo "<p style='color:red; text-align:center;'>$erro</p>"; ?>

<?php include('includes/footer.php'); ?>

