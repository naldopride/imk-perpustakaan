<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BOOK - PerpusKita</title>
         <!-- Path relatif ke CSS -->
         <link rel="stylesheet" href="../css/koleksi.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navbar -->
    <header class="header">
      <div class="header-left">
        <img
          src="../img/chat-gpt-image-29-apr-2025-21-23-28-20.png"
          alt="Logo"
          class="logo-icon"
        />
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
          <a href="../pages/profil.php">
            <img src="../img/account-circle0.svg" alt="User" class="icon" />
          </a>
        </div>
      </div>
    </header>
  <!-- Main content -->
 <!-- Main content -->
<main class="container">
  <h2 class="section-title">RIWAYAT PEMINJAMAN</h2>

  <table class="history-table">
    <thead>
      <tr>
        <th>Judul Buku</th>
        <th>Id Buku</th>
        <th>Tgl Peminjaman</th>
        <th>Tgl Pengembalian</th>
        <th>Batas Pengembalian</th>
        <th>Denda</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sang Raja Hutan</td>
        <td>919-666-728-632</td>
        <td>07-05-2024</td>
        <td>21-05-2024</td>
        <td>20-05-2024</td>
        <td class="denda">0</td>
      </tr>
      <tr>
        <td>Will Never<br />Found You</td>
        <td>364-718-637-823</td>
        <td>23-04-2024</td>
        <td>07-05-2024</td>
        <td>07-05-2024</td>
        <td class="denda">0</td>
      </tr>
    </tbody>
  </table>
</main>

  <!-- Footer -->
  <footer class="footer">
    <p>Perpuskita@</p>
  </footer>
 </body>
</html>