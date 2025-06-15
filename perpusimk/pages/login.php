<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOOK - PerpusKita</title>
  <link rel="stylesheet" href="../css/login.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
    rel="stylesheet"

  />
</head>
<body>
<body>
  <img class="background-image" src="../img/istockphoto-1386193712-612x612.jpg" alt="bg" />

  <!-- Navbar -->
  <header class="header">
    <div class="header-left">
      <img src="../img/chat-gpt-image-29-apr-2025-21-23-28-20.png" alt="Logo" class="logo-icon" />
    </div>
    
  </header>

  <!-- Login Form -->
  <main>
    <div class="login-container">
      <h2 class="masuk">MASUK</h2>

      <!-- Pesan error jika ada -->
      <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
      <?php endif; ?>

      <form method="post" action="../php/login.php">
        <label for="username">NAMA PENGGUNA</label>
        <input type="text" id="username" name="nama_pengguna" required />

        <label for="password">KATA SANDI</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">MASUK</button>
      </form>

      <p class="extra-text">
        BELUM PUNYA AKUN? <a href="regis.php" class="daftar-akun">DAFTAR AKUN</a>
      </p>
    </div>
  </main>

  <footer class="footer">
    <p>PerpusKita@</p>
  </footer>
</body>
</html>
