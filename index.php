<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Biblioteca Online</title>
<link rel="stylesheet" href="style.css">

  <style>
    .fade-out {
      opacity: 0;
      transition: opacity 0.3s ease;
    }
  </style>
</head>
<body>
  <header>
    <h1>Biblioteca Online</h1>
  </header>

  <nav>
    <button class="tab-btn active" data-tab="gallery-tab">Galeria</button>
    <button class="tab-btn" data-tab="add-tab">Cadastro</button>
    <button class="tab-btn" data-tab="details-tab">Detalhes</button>
    <button onclick="window.location.href='logout.php'">Sair</button>

  </nav>

  <main>
    <section id="gallery-tab" class="tab-content active">
      <div class="gallery" id="gallery">  
</div>

    </section>

    <section id="add-tab" class="tab-content">
      <form id="book-form">
        <input type="text" id="title" name="title" placeholder="Título do livro" required />
        <input type="url" id="image" name="image" placeholder="URL da imagem de capa" required />
        <input type="url" id="link" name="link" placeholder="Link para o livro" required />
        <textarea id="description" name="description" placeholder="Descrição do livro" rows="4" required></textarea>
        <button type="submit">Adicionar Livro</button>
      </form>

    </section>

    <section id="details-tab" class="tab-content">
      <div id="book-details">
        <p>Selecione um livro na galeria para ver os detalhes aqui.</p>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Biblioteca Online. Todos os direitos reservados.</p>
  </footer>
  
  <script src="script.js"></script>
</body>
</html>