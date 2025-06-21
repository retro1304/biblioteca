<?php
require 'conexao.php';

$titulo = $_POST['titulo'] ?? '';
$imagem = $_POST['imagem'] ?? '';
$link = $_POST['link'] ?? '';
$descricao = $_POST['descricao'] ?? '';

if ($titulo && $imagem && $link && $descricao) {
    $stmt = $conexao->prepare("INSERT INTO livros (titulo, imagem, link, descricao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $titulo, $imagem, $link, $descricao);
    
    if ($stmt->execute()) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Preencha todos os campos!";
}
?>
