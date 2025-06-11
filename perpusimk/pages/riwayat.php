<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include '../php/db.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data dari tabel riwayat_peminjaman + buku
$stmt = $conn->prepare("SELECT b.judul, b.id_buku, r.tanggal_pinjam, r.tanggal_batas, r.tanggal_kembali, r.denda
                        FROM riwayat_peminjaman r
                        JOIN buku b ON r.id_buku = b.id_buku
                        WHERE r.id_user = ?
                        ORDER BY r.tanggal_pinjam DESC");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Peminjaman - PerpusKita</title>
    <link rel="stylesheet" href="../css/riwayat.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->
    <header class="header">
      <div class="header-left">
        <img src="../img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
      </div>
      <div class="header-right">
        <nav class="nav-menu">
          <a class="nav-item" href="../index.php">Home</a>
          <a class="nav-item" href="koleksi.php">Koleksi</a>
          <a class="nav-item" href="layanan.html">Layanan</a>
        </nav>
        <div class="icons">
          <a href="../notifikasi.html"><img src="../img/bell0.svg" alt="Notifikasi" class="icon" /></a>
          <a href="../pages/profil.php"><img src="../img/account-circle0.svg" alt="User" class="icon" /></a>
        </div>
      </div>
    </header>

    <!-- Main content -->
    <main class="container">
      <h2 class="section-title">RIWAYAT PEMINJAMAN</h2>

      <table class="history-table">
        <thead>
          <tr>
            <th>Judul Buku</th>
            <th>ID Buku</th>
            <th>Tgl Peminjaman</th>
            <th>Tgl Pengembalian</th>
            <th>Batas Pengembalian</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><?= htmlspecialchars($row['id_buku']) ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_pinjam'])) ?></td>
            <td>
              <?= $row['tanggal_kembali'] ? date('d-m-Y', strtotime($row['tanggal_kembali'])) : '-' ?>
            </td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_batas'])) ?></td>
            <td class="denda"><?= $row['denda'] ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </main>

    <!-- Footer -->
    <footer class="footer">
      <p>Perpuskita@</p>
    </footer>
  </body>
</html>
