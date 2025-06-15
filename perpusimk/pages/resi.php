<?php
session_start();
include '../php/db.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data peminjaman terbaru user
$query = "SELECT r.*, b.judul FROM riwayat_peminjaman r 
          JOIN buku b ON r.id_buku = b.id_buku
          WHERE r.id_user = ? ORDER BY r.id_resi DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
  echo "<p style='padding:20px;'>Belum ada data peminjaman.</p>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Resi Pengambilan Buku</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9fff2;
      padding: 40px;
    }
    .resi-box {
      max-width: 500px;
      margin: 0 auto;
      padding: 30px;
      border: 1px dashed #4b7c5c;
      border-radius: 10px;
      background-color: #ffffff;
    }
    h2 {
      text-align: center;
      color: #2f523d;
    }
    .resi-item {
      margin: 10px 0;
    }
    .resi-label {
      font-weight: bold;
    }
    .download-btn {
      display: block;
      margin-top: 20px;
      background-color: #4b7c5c;
      color: white;
      padding: 10px;
      text-align: center;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .download-btn:hover {
      background-color: #3a634a;
    }
  </style>
</head>
<body>

<div class="resi-box" id="resi-content">
  <h2>📦 Resi Pengambilan Buku</h2>
  <div class="resi-item"><span class="resi-label">Nama:</span> <?= htmlspecialchars($_SESSION['nama_pengguna']) ?></div>
  <div class="resi-item"><span class="resi-label">Judul Buku:</span> <?= htmlspecialchars($data['judul']) ?></div>
  <div class="resi-item"><span class="resi-label">ID Buku:</span> <?= $data['id_buku'] ?></div>
  <div class="resi-item"><span class="resi-label">Tanggal Pinjam:</span> <?= date("d-m-Y", strtotime($data['tanggal_pinjam'])) ?></div>
  <div class="resi-item"><span class="resi-label">Batas Kembali:</span> <?= date("d-m-Y", strtotime($data['tanggal_batas'])) ?></div>
  <div class="resi-item"><span class="resi-label">Kode Resi:</span> RESI-<?= str_pad($data['id_resi'], 5, '0', STR_PAD_LEFT) ?></div>
</div>

<a href="#" id="download-resi" class="download-btn">📥 Download Resi PDF</a>

<!-- Script HTML to PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
  document.getElementById("download-resi").addEventListener("click", function () {
    const element = document.getElementById("resi-content");

    const opt = {
      margin:       0.5,
      filename:     'resi_pengambilan.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
  });
</script>

</body>
</html>
