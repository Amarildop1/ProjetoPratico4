<?php
session_start();
include('db/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query_check = "SELECT * FROM clientes WHERE email='$email'";
    $res_check = mysqli_query($conexao, $query_check);
    if (mysqli_num_rows($res_check) > 0) {
        $erro = "Email já cadastrado.";
    } else {
        $query = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        if (mysqli_query($conexao, $query)) {
            $_SESSION['cliente_id'] = mysqli_insert_id($conexao);
            $_SESSION['cliente_nome'] = $nome;
            header('Location: produtos.php');
            exit();
        } else {
            $erro = "Erro no cadastro.";
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<h1 class="titulo-center">Cadastro de Cliente</h1>

<form method="POST" action="cadastro.php">
    <input type="text" name="nome" placeholder="Seu nome" required />
    <input type="email" name="email" placeholder="Seu e-mail" required />
    <input type="password" name="senha" placeholder="Senha" required />
    <input type="submit" value="Cadastrar" />
</form>

<?php if (isset($erro)) echo "<p style='color:red; text-align:center;'>$erro</p>"; ?>

<?php include('includes/footer.php'); ?>
