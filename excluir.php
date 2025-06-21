<?php
require 'conexao.php';

$id = $_POST['id'];

$sql = "DELETE FROM livros WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Livro excluído com sucesso!";
} else {
    echo "Erro ao excluir livro.";
}

$stmt->close();
$conexao->close();
?>
