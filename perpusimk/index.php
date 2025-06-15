<?php
include 'php/db.php'; // Pastikan path file koneksi benar

// Ambil data buku dari database
$sql = "SELECT * FROM buku ORDER BY id_buku DESC"; // ditambahkan agar buku terbaru muncul duluan
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
  <style>
    .carousel-wrapper {
      overflow-x: auto;
      overflow-y: hidden;
      white-space: nowrap;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      padding: 10px 0;
    }

    .book-list {
      display: inline-flex;
      gap: 20px;
      padding-left: 10px;
    }

    .book {
      flex: 0 0 auto;
      width: 150px;
      background: #f9f9f9;
      border-radius: 10px;
      text-align: center;
      padding: 10px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .book img {
      width: 100%;
      border-radius: 5px;
    }
  </style>
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
    </div>
    <!-- Carousel Buku -->
    <div class="carousel-wrapper" id="carouselWrapper">
      <div class="book-list">
        <?php foreach ($books as $book): ?>
          <div class="book"
               data-kategori="<?= htmlspecialchars($book['kategori']) ?>"
               data-genre="<?= htmlspecialchars($book['kategori']) ?>">
            <img src="img/<?= htmlspecialchars($book['cover']) ?>" alt="<?= htmlspecialchars($book['judul']) ?>">
            <h4><?= htmlspecialchars($book['judul']) ?></h4>
            <p>oleh: <?= htmlspecialchars($book['penulis']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="rekomendasi">
  <h3>Rekomendasi</h3>
  <div class="rekomendasi-wrapper">
    <button class="arrow prev" onclick="scrollRekomendasi(-1)">&#10094;</button>
    <div class="carousel-container" id="rekomendasiCarousel">
      <?php foreach ($books as $book): ?>
        <div class="book" data-kategori="<?= htmlspecialchars($book['kategori']) ?>">
          <img src="img/<?= htmlspecialchars($book['cover']) ?>" alt="<?= htmlspecialchars($book['judul']) ?>">
          <h4><?= htmlspecialchars($book['judul']) ?></h4>
          <p>oleh: <?= htmlspecialchars($book['penulis']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="arrow next" onclick="scrollRekomendasi(1)">&#10095;</button>
  </div>
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
    function scrollRekomendasi(direction) {
  const container = document.getElementById('rekomendasiCarousel');
  const scrollAmount = 160;
  container.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth'
  });
}

    const slider = document.getElementById('carouselWrapper');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
      isDown = true;
      slider.classList.add('active');
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
      isDown = false;
      slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 2; // geser lebih cepat
      slider.scrollLeft = scrollLeft - walk;
    });

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