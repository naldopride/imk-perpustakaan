<?php
include '../php/db.php';

// Ambil kategori dari URL (GET)
$kategoriDipilih = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Query database sesuai kategori
if ($kategoriDipilih === 'Semua') {
  $query = "SELECT * FROM buku";
  $stmt = $conn->prepare($query);
} else {
  $query = "SELECT * FROM buku WHERE kategori = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $kategoriDipilih);
}

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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>BOOK - PerpusKita</title>
  <link rel="stylesheet" href="../css/koleksi.css" />
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
        <a href="../notifikasi.html">
          <img src="../img/bell0.svg" alt="Notifikasi" class="icon" />
        </a>
        <a href="../pages/profil.php">
          <img src="../img/account-circle0.svg" alt="User" class="icon" />
        </a>
      </div>
    </div>
  </header>

  <main>
    <aside>
      <button class="title">KOLEKSI</button>
      <nav>
        <a href="koleksi.php?kategori=Semua" class="<?= $kategoriDipilih === 'Semua' ? 'selected' : '' ?>">Semua</a>
        <a href="koleksi.php?kategori=Cerpen" class="<?= $kategoriDipilih === 'Cerpen' ? 'selected' : '' ?>">Cerpen</a>
        <a href="koleksi.php?kategori=Komik" class="<?= $kategoriDipilih === 'Komik' ? 'selected' : '' ?>">Komik</a>
        <a href="koleksi.php?kategori=Ensiklopedia" class="<?= $kategoriDipilih === 'Ensiklopedia' ? 'selected' : '' ?>">Ensiklopedia</a>
        <a href="koleksi.php?kategori=Antologi" class="<?= $kategoriDipilih === 'Antologi' ? 'selected' : '' ?>">Antologi</a>
        <a href="koleksi.php?kategori=Novel" class="<?= $kategoriDipilih === 'Novel' ? 'selected' : '' ?>">Novel</a>
        <a href="koleksi.php?kategori=Biografi" class="<?= $kategoriDipilih === 'Biografi' ? 'selected' : '' ?>">Biografi</a>
      </nav>
    </aside>

    <section>
      <div class="quote">
        "Kamu bisa tersesat di perpustakaan mana pun, berapa pun ukurannya.
        Tetapi, makin kamu tersesat, makin banyak hal yang akan kamu temukan."
      </div>
      <div class="grid">
        <?php foreach ($bukuList as $buku): ?>
          <a href="/perpusimk/pages/book.php?id=<?= $buku['id_buku'] ?>">
            <img
              src="../img/<?= htmlspecialchars($buku['cover']) ?>"
              alt="<?= htmlspecialchars($buku['judul']) ?>"
            />
          </a>
        <?php endforeach; ?>

        <?php if (count($bukuList) === 0): ?>
          <p style="padding: 1rem;">Tidak ada buku dalam kategori ini.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>
</body>
</html>
