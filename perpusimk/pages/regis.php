<?php
// Panggil file koneksi database & logika registrasi
include '../php/regis.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOOK - PerpusKita</title>
  <link rel="stylesheet" href="../css/regis.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet"
  />
</head>
<body>
<img class="background-image" src="../img/istockphoto-1386193712-612x612.jpg" alt="bg" />
  <!-- Navbar -->
  <header class="header">
    <div class="header-left">
      <img src="../img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
    </div>
    
    </div>
  </header>

  <!-- Form Registrasi -->
  <main>
    <div class="form-container">
      <h2>REGISTRASI</h2>

      <!-- Tampilkan error/sukses -->
      <?php if (!empty($error)): ?>
        <p class="error" style="color:red;"><?= htmlspecialchars($error) ?></p>
      <?php elseif (!empty($success)): ?>
        <p class="success" style="color:green;"><?= htmlspecialchars($success) ?></p>
      <?php endif; ?>

      <form method="post" action="">
        <label>Nama Pengguna</label>
        <input type="text" name="nama_pengguna" required />

        <label>Email</label>
        <input type="email" name="email" required />

        <label>Alamat</label>
        <input type="text" name="alamat" required />

        <label>Nomor Handphone</label>
        <input type="text" name="no_hp" required />

        <label>Kata Sandi</label>
        <input type="password" name="password" required />

        <label>Konfirmasi Kata Sandi</label>
        <input type="password" name="konfirmasi_password" required />

        <div class="form-buttons">
          <button type="submit" class="btn-daftar">DAFTAR</button>
          <a href="login.php" class="masuk-link">MASUK</a>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>
</body>
</html>
