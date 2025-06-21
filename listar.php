<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost", "root", "", "biblioteca");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro na conexão com o banco de dados"]);
    exit;
}

$sql = "SELECT * FROM livros ORDER BY titulo";
$result = $conn->query($sql);

$livros = [];

while ($row = $result->fetch_assoc()) {
    $livros[] = $row;
}

echo json_encode($livros);
$conn->close();
?>