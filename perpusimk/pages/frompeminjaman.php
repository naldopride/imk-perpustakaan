<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include '../php/db.php';

if (!isset($_SESSION['id_user'])) {
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
  header("Location: ../pages/login.php?redirect=frompeminjaman&id=$id");
  exit();
}

$id_buku = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id_buku);
$stmt->execute();
$result = $stmt->get_result();
$buku = $result->fetch_assoc();

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
  <title>Form Peminjaman - PerpusKita</title>
  <link rel="stylesheet" href="../css/frompeminjaman.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
</head>
<body>
  <header class="header">
    <div class="header-left">
      <img src="../img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
    </div>
    <div class="header-right">
      <nav class="nav-menu">
        <a class="nav-item" href="../index.php">Home</a>
        <a class="nav-item" href="../pages/koleksi.php">Koleksi</a>
        <a class="nav-item" href="../pages/layanan.html">Layanan</a>
      </nav>
      <div class="icons">
        <a href="../notifikasi.html"><img src="../img/bell0.svg" alt="Notifikasi" class="icon" /></a>
        <a href="../pages/profil.php"><img src="../img/account-circle0.svg" alt="User" class="icon" /></a>
      </div>
    </div>
  </header>

  <main>
    <!-- Form Section -->
    <section class="form-section">
      <h3>Form Peminjaman</h3>
      <form action="../php/proses_peminjaman.php" method="POST">
        <div class="form-group">
          <label>Nama Lengkap :</label>
          <input type="text" name="nama_pengguna" value="<?= $_SESSION['nama_pengguna'] ?? '' ?>" required />
        </div>

        <div class="form-group">
          <label>Alamat Email :</label>
          <input type="email" name="email" value="<?= $_SESSION['email'] ?? '' ?>" required />
        </div>

        <div class="form-group">
          <label>Alamat Lengkap :</label>
          <input type="text" name="alamat" value="<?= $_SESSION['alamat'] ?? '' ?>" required />
        </div>

        <div class="form-group">
          <label>ID Buku :</label>
          <input type="text" name="id_buku" value="<?= htmlspecialchars($buku['id_buku']) ?>" readonly />
        </div>

        <button class="submit-btn" type="submit">Ajukan</button>
      </form>
    </section>

    <!-- Book Detail Section -->
    <section class="book-section">
      <h3>Detail Buku</h3>
      <div class="book-card">
        <img src="../img/<?= htmlspecialchars($buku['cover']) ?>" alt="Sampul Buku" />
        <div class="book-info">
          <p><strong>Judul Buku :</strong> <?= htmlspecialchars($buku['judul']) ?></p>
          <p><strong>Halaman :</strong> <?= htmlspecialchars($buku['halaman']) ?></p>
          <p><strong>ID :</strong> <?= htmlspecialchars($buku['id_buku']) ?></p>
        </div>
      </div>
      <div class="synopsis-btn">Sinopsis</div>
      <p class="synopsis-text"><?= htmlspecialchars($buku['sipnosis']) ?></p>
    </section>
  </main>

  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>
</body>
</html>
