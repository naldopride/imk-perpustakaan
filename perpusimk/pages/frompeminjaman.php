<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BOOK - PerpusKita</title>
    <link rel="stylesheet" href="css/frompeminjaman.css" />
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
          src="img/chat-gpt-image-29-apr-2025-21-23-28-20.png"
          alt="Logo"
          class="logo-icon"
        />
      </div>

      <div class="header-right">
        <div class="header-right">
          <nav class="nav-menu">
            <a class="nav-item" href="index.php">Home</a>
            <a class="nav-item" href="pages/koleksi.php">Koleksi</a>
            <a class="nav-item" href="pages/layanan.html">Layanan</a>
          </nav>
        </div>

        <div class="icons">
          <a href="notifikasi.html">
            <img src="img/bell0.svg" alt="Notifikasi" class="icon" />
          </a>
          <a href="profil.html">
            <img src="img/account-circle0.svg" alt="User" class="icon" />
          </a>
        </div>
        
    </header>

    <main>
      <section class="form-section">
        <h3>Form Peminjaman</h3>
        <form>
          <label>Nama Lengkap :</label>
          <input type="text" />

          <label>Alamat Email :</label>
          <input type="email" />

          <label>Alamat Lengkap :</label>
          <input type="text" />

          <label>ID Buku :</label>
          <div class="id-buku-row">
            <input type="text" />
            <button type="button" class="check-btn">Check</button>
          </div>
        </form>
      </section>

      <section class="book-section">
        <h3>Detail Buku</h3>
        <div class="book-card">
          <img
            src="Home/sang raja hutan.jpeg"
            alt="Sampul Buku"
          />
          <div class="book-info">
            <p><strong>Judul Buku :</strong> SANG RAJA HUTAN</p>
            <p><strong>Halaman :</strong> 30</p>
            <p><strong>ID :</strong>919-666-728-632</p>
          </div>
        </div>
        <button class="synopsis-btn">Sinopsis</button>
        <p class="synopsis-text">
          Aku adalah anak dari seorang raja hutan, ayahku yang bernama musafa,
          ayahku memberi namaku somba.
        </p>
        <button class="submit-btn">Ajukan</button>
      </section>
    </main>

    <footer class="footer">
      <p>PerpusKita@</p>
    </footer>
  </body>
</html>
