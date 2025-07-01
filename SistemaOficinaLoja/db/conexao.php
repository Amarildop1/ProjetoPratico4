<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "oficina_motos_motores";

$conexao = mysqli_connect($host, $user, $password, $dbname);

if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>
