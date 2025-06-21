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
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('d/m/Y H:i:s');
    $mensagem = "[$data] Usuário '$usuario' fez login.\n";
    file_put_contents('log_acesso.txt', $mensagem, FILE_APPEND);
    header('Location: index.php');
    exit();
} else {
    header('Location: login.php?erro=1');
    exit();
}
?>
