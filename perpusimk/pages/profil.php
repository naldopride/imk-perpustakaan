<?php
// profil.php
include '../php/db.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['nama_pengguna'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari database
$nama_pengguna = $_SESSION['nama_pengguna'];
$stmt = $conn->prepare("SELECT nama_pengguna, email, alamat, no_hp FROM user WHERE nama_pengguna = ?");
$stmt->bind_param("s", $nama_pengguna);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOOK - PerpusKita</title>
  <link rel="stylesheet" href="../css/profil.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet"
  />
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
        <a href="../notifikasi.html">
          <img src="../img/bell0.svg" alt="Notifikasi" class="icon" />
        </a>
        <a href="profil.php">
          <img src="../img/account-circle0.svg" alt="User" class="icon" />
        </a>
      </div>
    </div>
  </header>

  <main>
<section class="profile-header">
  <h2>Profil Diri</h2>
 <form action="../php/logout.php" method="post" style="display:inline;">
  <button aria-label="Logout">
    <i class="fas fa-sign-out-alt"></i>
  </button>
</form>

</section>



    <section class="profile-content">
      <div class="profile-left">
        <div class="profile-image-container">
          <img
            src="https://storage.googleapis.com/a1aa/image/c4ef0deb-5266-426e-ff0c-1b9bdc2f97c8.jpg"
            alt="Profile Picture"
          />
          <button aria-label="Change profile picture">
            <i class="fas fa-camera"></i>
          </button>
        </div>
        <div class="profile-buttons">
          <a href="riwayat.html"><button>Histori Peminjaman</button></a>
          <a href="bukusimpan.html"><button>Buku Tersimpan</button></a>
        </div>
      </div>

      <div class="profile-right">
        <div class="section-block">
          <h3 class="section-title">Identitas</h3>
          <p><span>Nama Lengkap :</span><br /><?= htmlspecialchars($user['nama_pengguna']) ?></p>
          <p><span>Alamat Lengkap :</span><br /><?= htmlspecialchars($user['alamat']) ?></p>
        </div>
        <div class="section-block">
          <h3 class="section-title">Kontak</h3>
          <p><span>Handphone :</span><br /><?= htmlspecialchars($user['no_hp']) ?></p>
          <p><span>Alamat Email :</span><br /><?= htmlspecialchars($user['email']) ?></p>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>
</body>
</html>
