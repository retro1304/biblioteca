<?php
session_start();
include('conexao.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_num_rows($result);

if ($row > 0) {
    $_SESSION['usuario'] = $usuario;
    header('Location: index.php');
    exit();
} else {
    header('Location: login.php?erro=1');
    exit();
}
?>
