const user = prompt("Informe seu nome para entrar:");
if (!user) {
  alert("Você precisa se identificar para acessar o site.");
  document.body.innerHTML = "<h2 style='text-align:center; margin-top:50px;'>Acesso negado.</h2>";
  throw new Error("Acesso negado.");
}

const galleryEl = document.getElementById('gallery');
const detailsEl = document.getElementById('book-details');
const form = document.getElementById('book-form');
const tabs = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');

// Carrega livros do banco de dados via PHP
let books = [];

function loadGallery() {
  fetch('listar.php')
    .then(res => res.json())
    .then(data => {
      console.log("Dados recebidos do PHP:", data);
      books = data;
      galleryEl.innerHTML = '';
      books.forEach((book, i) => {
        galleryEl.appendChild(createBookCard(book, i));
      });
    });
}

function createBookCard(book, index) {
  const div = document.createElement('div');
  div.className = 'book';

  div.addEventListener('click', (e) => {
    if (e.target.classList.contains('delete-btn')) {
      return;
    }
    window.open(book.link, '_blank');
    showBookDetails(book);
    activateTab('details-tab');
  });

  div.innerHTML = `
    <img src="${book.imagem}" alt="Capa do livro ${book.titulo}" />
    <p>${book.titulo}</p>
    <button class="delete-btn" title="Excluir livro">Excluir</button>
  `;

  const deleteBtn = div.querySelector('.delete-btn');
  deleteBtn.addEventListener('click', () => {
    if (confirm("Tem certeza que deseja excluir este livro?")) {
      fetch('excluir.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${book.id}`
      })
      .then(() => loadGallery());
    }
  });

  return div;
}

function showBookDetails(book) {
  detailsEl.innerHTML = `
    <h2>${book.titulo}</h2>
    <img src="${book.imagem}" alt="Capa do livro ${book.titulo}" />
    <p>${book.descricao}</p>
    <p><a href="${book.link}" target="_blank" rel="noopener">Comprar/Ler livro</a></p>
  `;
}

function activateTab(id) {
  tabs.forEach(b => b.classList.remove('active'));
  tabContents.forEach(tc => tc.classList.remove('active'));

  document.querySelector(`button[data-tab="${id}"]`).classList.add('active');
  document.getElementById(id).classList.add('active');
}

form.addEventListener('submit', e => {
  e.preventDefault();


  const titulo = form.title.value.trim();
  const imagem = form.image.value.trim();
  const link = form.link.value.trim();
  const descricao = form.description.value.trim();

  if (!titulo || !imagem || !link || !descricao) {
    alert('Preencha todos os campos.');
    return;
  }

  const dados = new URLSearchParams();
  dados.append('titulo', titulo);
  dados.append('imagem', imagem);
  dados.append('link', link);
  dados.append('descricao', descricao);

  fetch('criar.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: dados.toString()
  })
  .then(() => {
    alert('Livro adicionado com sucesso!');
    form.reset();
    loadGallery();
    activateTab('gallery-tab');
  });
});

// Inicia carregamento inicial da galeria
document.addEventListener('DOMContentLoaded', loadGallery);

// Função para mudar de aba
tabs.forEach(btn => {
  btn.addEventListener('click', () => {
    tabs.forEach(b => b.classList.remove('active'));
    tabContents.forEach(tc => tc.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(btn.dataset.tab).classList.add('active');
  });
});