<?php
session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Biblioteca</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Login - Biblioteca</h2>
  <form method="POST" action="verificar_login.php">
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
  </form>

  <?php
    if (isset($_GET['erro'])) {
      echo "<p style='color:red;'>Usuário ou senha inválidos.</p>";
    }
  ?>
</body>
</html>