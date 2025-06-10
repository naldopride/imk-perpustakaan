<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include '../php/bukusimpan.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

// Query join arsip + buku
$stmt = $conn->prepare("
  SELECT a.id AS id_arsip, b.id_buku, b.judul, b.cover, b.penulis, b.kategori
  FROM arsip a
  JOIN buku b ON a.id_buku = b.id_buku
  WHERE a.id_user = ?
");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

$bukuList = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bukuList[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DAFTAR BUKU DISIMPAN - PerpusKita</title>
  <link rel="stylesheet" href="/perpusimk/css/simpan.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>
<body>
<header class="header">
  <div class="header-left">
    <img src="/perpusimk/img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
  </div>
  <div class="header-right">
    <nav class="nav-menu">
      <a class="nav-item" href="/perpusimk/index.php">Home</a>
      <a class="nav-item" href="/perpusimk/pages/koleksi.php">Koleksi</a>
      <a class="nav-item" href="/perpusimk/pages/layanan.html">Layanan</a>
    </nav>
    <div class="icons">
      <a href="/perpusimk/notifikasi.html"><img src="/perpusimk/img/bell0.svg" alt="Notifikasi" class="icon" /></a>
      <a href="/perpusimk/pages/profil.php"><img src="/perpusimk/img/account-circle0.svg" alt="User" class="icon" /></a>
    </div>
  </div>
</header>

<main class="main-content">
  <h1 class="main-title">DAFTAR BUKU YANG DISIMPAN</h1>
  <section aria-label="Saved books list" class="books-grid">
    <?php if (count($bukuList) > 0): ?>
      <?php foreach ($bukuList as $buku): ?>
        <article class="book-card">
          <img alt="Cover <?= htmlspecialchars($buku['judul']) ?>" class="book-cover" src="/perpusimk/img/<?= htmlspecialchars($buku['cover']) ?>" />
          <div class="book-info">
            <h2 class="book-title"><?= htmlspecialchars($buku['judul']) ?></h2>
            <p class="book-creator"><strong>Penulis :</strong><br /><?= htmlspecialchars($buku['penulis']) ?></p>
            <p class="book-genre">Kategori :<br /><?= htmlspecialchars($buku['kategori']) ?></p>
            <div class="book-buttons">
              <a href="book.php?id=<?= $buku['id_buku'] ?>" class="btn-open">BUKA BUKU</a>
              <a href="hapus.php?id=<?= $buku['id_arsip'] ?>" class="btn-remove">HAPUS DARI DAFTAR</a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="padding: 1rem;">Belum ada buku yang disimpan.</p>
    <?php endif; ?>
  </section>
</main>

<footer class="footer">
  <p>Perpuskita@</p>
</footer>
</body>
</html>
