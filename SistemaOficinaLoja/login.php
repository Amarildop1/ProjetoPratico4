<!-- login.php -->

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

<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Seu e-mail" required />
    <input type="password" name="senha" placeholder="Senha" required />
    <input type="submit" value="Entrar" />
</form>

<?php if (isset($erro)) echo "<p style='color:red; text-align:center;'>$erro</p>"; ?>

<?php include('includes/footer.php'); ?>
