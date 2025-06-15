<?php
include '../php/auth_admin.php'; 
include '../php/db.php';

// Ambil semua data buku
$buku_list_query = $conn->query("SELECT * FROM buku");

// Ambil data riwayat peminjaman
$riwayat_query = $conn->query("
  SELECT r.*, u.nama_pengguna, b.judul 
  FROM riwayat_peminjaman r
  JOIN user u ON r.id_user = u.id_user
  JOIN buku b ON r.id_buku = b.id_buku
  ORDER BY r.id_resi DESC
");

// Query: jumlah user
$user_query = $conn->query("SELECT COUNT(*) AS total_user FROM user");
$user_data = $user_query->fetch_assoc();

// Query: jumlah buku
$buku_query = $conn->query("SELECT COUNT(*) AS total_buku FROM buku");
$buku_data = $buku_query->fetch_assoc();

// Query: total peminjaman
$peminjaman_query = $conn->query("SELECT COUNT(*) AS total_peminjaman FROM peminjaman");
$peminjaman_data = $peminjaman_query->fetch_assoc();

// Query: user aktif (anggap semua aktif)
$aktif_query = $conn->query("SELECT COUNT(*) AS aktif FROM user");
$aktif_data = $aktif_query->fetch_assoc();

// Query: semua user
$user_list_query = $conn->query("SELECT id_user, nama_pengguna, email, alamat, no_hp FROM user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <span class="admin-title">ADMIN</span>
      <form method="post" action="../php/logout.php">
        <button class="logout-btn" type="submit">LOGOUT</button>
      </form>
    </div>

    <div class="sidebar">
      <a href="#" class="nav-item active" onclick="switchContent('dashboard')">Dashboard</a>
      <a href="#" class="nav-item" onclick="switchContent('kelola-buku')">Kelola Buku</a>
      <a href="#" class="nav-item" onclick="switchContent('riwayat')">Riwayat Peminjaman</a>
      <a href="#" class="nav-item" onclick="switchContent('kelola-user')">Kelola User</a>
    </div>

    <div class="main-content">
      <!-- DASHBOARD -->
      <div id="dashboard-content">
        <h2 class="dashboard-header">DASHBOARD</h2>
        <div class="stats-container">
          <div class="stat-card">
            <div class="stat-label">Jumlah User :</div>
            <div class="stat-value"><?= $user_data['total_user'] ?> <span class="stat-unit">orang</span></div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Jumlah Buku :</div>
            <div class="stat-value"><?= $buku_data['total_buku'] ?> <span class="stat-unit">buku</span></div>
          </div>
        </div>
        <div class="content-section">
          <h3 class="section-title">Statistik Sistem</h3>
          <div class="info-grid">
            <div class="info-item">
              <div class="info-label">Total Peminjaman</div>
              <div class="info-value"><?= $peminjaman_data['total_peminjaman'] ?> transaksi</div>
            </div>
            <div class="info-item">
              <div class="info-label">Total Buku</div>
              <div class="info-value"><?= $buku_data['total_buku'] ?> buku</div>
            </div>
            <div class="info-item">
              <div class="info-label">User Aktif</div>
              <div class="info-value"><?= $aktif_data['aktif'] ?> orang</div>
            </div>
          </div>
        </div>
      </div>

      <!-- KELOLA BUKU -->
      <div id="kelola-buku-content" style="display: none;">
        <h2 class="dashboard-header">KELOLA BUKU</h2>
        <div class="content-section">
          <h3 class="section-title">Manajemen Buku</h3>
          <a href="#" id="btnToggleForm" style="display:inline-block; background-color:#4CAF50; color:white; padding:10px 15px; border-radius:5px; text-decoration:none; margin-bottom:15px;">+ Tambah Buku</a>
          <div id="form-tambah-buku" style="display:none; margin-top:20px;">
          <form action="../php/tambah_buku.php" method="POST" enctype="multipart/form-data">
  <h3>Form Tambah Buku</h3>
  <label>Judul:</label><br><input type="text" name="judul" required><br>

  <label>Penulis:</label><br><input type="text" name="penulis" required><br>

  <label>Penerbit:</label><br><input type="text" name="penerbit" required><br>

  <label>Jumlah Halaman:</label><br><input type="number" name="halaman" required><br>

  <label>Kategori:</label><br><input type="text" name="kategori" required><br>

  <label>Lokasi Rak:</label><br><input type="text" name="location" required><br>

  <label>Sinopsis:</label><br>
  <textarea name="sipnosis" rows="4" cols="50" placeholder="Tulis sinopsis buku..." required></textarea><br>

  <label>Cover (jpg/png):</label><br><input type="file" name="cover" accept="image/*" required><br><br>

  <button type="submit" style="padding: 8px 16px; background-color:#4CAF50; color:white; border:none; border-radius:4px;">Simpan</button>
</form>

          </div>

          <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead style="background:#ecf0f1;">
              <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Halaman</th>
                <th>Kategori</th>
                <th>Lokasi</th>
              </tr>
            </thead>
            <tbody>
            <?php while ($buku = $buku_list_query->fetch_assoc()): ?>

                <tr>
                  <td><?= $buku['id_buku'] ?></td>
                  <td><?= htmlspecialchars($buku['judul']) ?></td>
                  <td><?= htmlspecialchars($buku['penulis']) ?></td>
                  <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                  <td><?= $buku['halaman'] ?></td>
                  <td><?= htmlspecialchars($buku['kategori']) ?></td>
                  <td><?= htmlspecialchars($buku['location']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- RIWAYAT -->
      <!-- RIWAYAT -->
<div id="riwayat-content" style="display: none;">
  <h2 class="dashboard-header">RIWAYAT PEMINJAMAN</h2>
  <div class="content-section">
    <h3 class="section-title">Data Riwayat Peminjaman</h3>

    <?php if ($riwayat_query && $riwayat_query->num_rows > 0): ?>
      <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <thead style="background:#ecf0f1;">
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Batas</th>
            <th>Tanggal Kembali</th>
            <th>Denda</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($riwayat = $riwayat_query->fetch_assoc()):
              $tanggal_batas = new DateTime($riwayat['tanggal_batas']);
              $tanggal_kembali = new DateTime($riwayat['tanggal_kembali']);
              $selisih = $tanggal_kembali > $tanggal_batas ? $tanggal_kembali->diff($tanggal_batas)->days : 0;
              $denda = $selisih * 10000;
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($riwayat['nama_pengguna']) ?></td>
              <td><?= htmlspecialchars($riwayat['judul']) ?></td>
              <td><?= htmlspecialchars($riwayat['tanggal_pinjam']) ?></td>
              <td><?= htmlspecialchars($riwayat['tanggal_batas']) ?></td>
              <td><?= htmlspecialchars($riwayat['tanggal_kembali']) ?></td>
              <td>Rp<?= number_format($denda, 0, ',', '.') ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Tidak ada data riwayat peminjaman.</p>
    <?php endif; ?>
  </div>
</div>


      <!-- KELOLA USER -->
      <div id="kelola-user-content" style="display: none;">
        <h2 class="dashboard-header">KELOLA USER</h2>
        <div class="content-section">
          <h3 class="section-title">Manajemen User</h3>
          <?php if ($user_list_query && $user_list_query->num_rows > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
              <thead style="background:#ecf0f1;">
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($user = $user_list_query->fetch_assoc()): ?>
                  <tr>
                    <td><?= htmlspecialchars($user['id_user']) ?></td>
                    <td><?= htmlspecialchars($user['nama_pengguna']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['alamat']) ?></td>
                    <td><?= htmlspecialchars($user['no_hp']) ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p>Tidak ada data user.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function switchContent(section) {
      document.getElementById("dashboard-content").style.display = "none";
      document.getElementById("kelola-buku-content").style.display = "none";
      document.getElementById("riwayat-content").style.display = "none";
      document.getElementById("kelola-user-content").style.display = "none";

      const navItems = document.querySelectorAll(".nav-item");
      navItems.forEach(item => item.classList.remove("active"));

      document.getElementById(`${section}-content`).style.display = "block";
      navItems.forEach(item => {
        if (item.textContent.toLowerCase().includes(section.replace('-', ' '))) {
          item.classList.add("active");
        }
      });
    }

    document.addEventListener("DOMContentLoaded", () => {
      switchContent("dashboard");

      const btn = document.getElementById("btnToggleForm");
      const form = document.getElementById("form-tambah-buku");
      if (btn && form) {
        btn.addEventListener("click", function(e) {
          e.preventDefault();
          form.style.display = form.style.display === "none" ? "block" : "none";
        });
      }
    });
  </script>
</body>
</html>
