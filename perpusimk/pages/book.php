<?php
include '../php/db.php';

// Ambil ID buku dari URL (GET)
$id_buku = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query data buku
$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();

$buku = $result->fetch_assoc();

// Kalau tidak ada buku, redirect ke koleksi
if (!$buku) {
  header("Location: koleksi.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOOK - <?= htmlspecialchars($buku['judul']) ?> - PerpusKita</title>
  <link rel="stylesheet" href="/perpusimk/css/book.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>
<body>
  <!-- Navbar -->
  <header class="header">
    <div class="header-left">
      <img src="/perpusimk/img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
    </div>
    <div class="header-right">
    <div class="header-right">
      <nav class="nav-menu">
        <a class="nav-item" href="/perpusimk/index.php">Home</a>
        <a class="nav-item" href="/perpusimk/pages/koleksi.php">Koleksi</a>
        <a class="nav-item" href="/perpusimk/pages/layanan.html">Layanan</a>
      </nav>
    </div>
    <div class="icons">
      <a href="/perpusimk/notifikasi.html">
        <img src="/perpusimk/img/bell0.svg" alt="Notifikasi" class="icon" />
      </a>
      <a href="/perpusimk/pages/profil.php">
        <img src="/perpusimk/img/account-circle0.svg" alt="User" class="icon" />
      </a>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="cover">
        <img src="/perpusimk/img/<?= htmlspecialchars($buku['cover']) ?>" alt="<?= htmlspecialchars($buku['judul']) ?>">
        <!-- FIXED path simpan ➜ /perpusimk/php/bukusimpan.php -->
        <a href="../php/bukusimpan.php?id=<?= $buku['id_buku'] ?>" class="btn simpan">SIMPAN</a>
        <a href="../pages/frompeminjaman.php?id=<?= $buku['id_buku'] ?>" class="btn pinjam">PINJAM</a>
      </div>
      <div class="detail">
        <h2><?= htmlspecialchars($buku['judul']) ?></h2>
        <p><strong>penulis:</strong> <?= htmlspecialchars($buku['penulis']) ?><br>
        <strong>penerbit:</strong> <?= htmlspecialchars($buku['penerbit']) ?></p>
        <strong>Location:</strong> <?= htmlspecialchars($buku['location']) ?></p>
        <p>📚 <?= htmlspecialchars($buku['id_buku']) ?></p>
        <p>📖 <?= htmlspecialchars($buku['halaman']) ?> Halaman</p>
        <br>
        <div class="sipnosis">
          <h3>Sinopsis</h3>
          <p><?= htmlspecialchars($buku['sipnosis']) ?></p>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>Perpuskita@</p>
  </footer>
</body>
</html>