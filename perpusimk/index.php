<?php
include 'php/db.php'; // Pastikan path file koneksi benar

// Ambil data buku dari database
$sql = "SELECT * FROM buku";
$result = $conn->query($sql);

$books = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $books[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOOK - PerpusKita</title>
  <link rel="stylesheet" href="css/perpuskita.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>
<body>
  <!-- Navbar -->
  <header class="header">
    <div class="header-left">
      <img src="img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
    </div>
    <div class="header-right">
      <nav class="nav-menu">
        <a class="nav-item" href="index.php">Home</a>
        <a class="nav-item" href="pages/koleksi.php">Koleksi</a>
        <a class="nav-item" href="pages/layanan.html">Layanan</a>
      </nav>
      <div class="icons">
        <a href="../notifikasi.html">
          <img src="img/bell0.svg" alt="Notifikasi" class="icon" />
        </a>
        <a href="pages/profil.php">
          <img src="img/account-circle0.svg" alt="User" class="icon" />
        </a>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <div class="hero">
    <div class="hero-left">
      <h1>BUKU TERBARU</h1>
      <h2>Jelajahi koleksi terbaru kami</h2>
      <button>Lihat Koleksi</button>
    </div>
    <div class="puppet">
      <img src="img/chat-gpt-image-apr-29-2025-10-09-57-pm-removebg-preview-10.png" alt="puppet">
    </div>
    <div class="hero-right">
      <input type="text" id="heroSearch" placeholder="Cari buku..." onkeyup="filterBooks()">
    </div>
  </div>

  <!-- Rekomendasi -->
  <div class="rekomendasi">
    <h3>Rekomendasi</h3>
    <button class="arrow prev" onclick="scrollBooks(-1)">&lt; Previous</button>
    <div class="carousel-wrapper">
      <div class="book-list" id="bookList">
        <?php foreach ($books as $book): ?>
          <div class="book" data-kategori="<?= htmlspecialchars($book['kategori']) ?>" data-genre="<?= htmlspecialchars($book['kategori']) ?>">
            <img src="img/<?= htmlspecialchars($book['cover']) ?>" alt="<?= htmlspecialchars($book['judul']) ?>">
            <h4><?= htmlspecialchars($book['judul']) ?></h4>
            <p>oleh: <?= htmlspecialchars($book['penulis']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <button class="arrow next" onclick="scrollBooks(1)">Next &gt;</button>
  </div>

  <!-- Kategori -->
  <div class="section">
    <h4>Kategori</h4>
    <div class="kategori-list">
      <button onclick="filterByCategory('Semua')" class="active">Kategori</button>
      <button onclick="filterByCategory('Populer')">Populer</button>
      <button onclick="filterByCategory('Terbaru')">Terbaru</button>
      <button onclick="filterByCategory('Fiksi')">Fiksi</button>
      <button onclick="filterByCategory('Non-Fiksi')">Non-Fiksi</button>
      <button onclick="filterByCategory('Novel')">Novel</button>
      <button onclick="filterByCategory('Komik')">Komik</button>
      <button onclick="filterByCategory('Ensiklopedia')">Ensiklopedia</button>
    </div>
    <div class="semua-buku" id="semuaBuku">
      <?php foreach ($books as $book): ?>
        <div class="book" data-kategori="<?= htmlspecialchars($book['kategori']) ?>" data-genre="<?= htmlspecialchars($book['kategori']) ?>">
          <img src="img/<?= htmlspecialchars($book['cover']) ?>" alt="<?= htmlspecialchars($book['judul']) ?>">
          <h4><?= htmlspecialchars($book['judul']) ?></h4>
          <p>oleh: <?= htmlspecialchars($book['penulis']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>

  <script>
    const bookList = document.getElementById('bookList');
    const bookItems = bookList.children;
    const visibleBooks = 5;
    const bookWidth = 120;
    let currentIndex = 0;

    function scrollBooks(direction) {
      currentIndex += direction;
      if (currentIndex < 0) {
        currentIndex = bookItems.length - visibleBooks;
      } else if (currentIndex > bookItems.length - visibleBooks) {
        currentIndex = 0;
      }
      bookList.style.transform = `translateX(${-currentIndex * bookWidth}px)`;
    }

    function filterBooks() {
      const input = document.getElementById('heroSearch').value.toLowerCase();
      const books = document.querySelectorAll('#semuaBuku .book');

      books.forEach(book => {
        const title = book.querySelector('h4').textContent.toLowerCase();
        const kategori = book.getAttribute('data-kategori').toLowerCase();
        const genre = book.getAttribute('data-genre').toLowerCase();

        if (title.includes(input) || kategori.includes(input) || genre.includes(input)) {
          book.style.display = 'block';
        } else {
          book.style.display = 'none';
        }
      });
    }

    function filterByCategory(kategori) {
      const buttons = document.querySelectorAll('.kategori-list button');
      buttons.forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');

      const books = document.querySelectorAll('#semuaBuku .book');
      books.forEach(book => {
        const kat = book.getAttribute('data-kategori');
        if (kategori === 'Semua' || kat === kategori) {
          book.style.display = 'block';
        } else {
          book.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
