<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include 'db.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../pages/login.php");
  exit();
}

// Ambil data dari form
$id_user = $_SESSION['id_user'];
$nama = $_POST['nama_pengguna'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$id_buku = intval($_POST['id_buku']);

// Tanggal peminjaman dan batas kembali
$tanggal_pinjam = date("Y-m-d");
$tanggal_batas = date("Y-m-d", strtotime("+5 days"));

// 1. Simpan ke tabel peminjaman
$stmt1 = $conn->prepare("INSERT INTO peminjaman (id_user, id_buku, nama_pengguna, alamat, email) VALUES (?, ?, ?, ?, ?)");
$stmt1->bind_param("iisss", $id_user, $id_buku, $nama, $alamat, $email);
$stmt1->execute();

// 2. Ambil ID peminjaman yang baru saja disimpan
$id_peminjaman = $conn->insert_id;

// 3. Simpan juga ke tabel riwayat_peminjaman
$stmt2 = $conn->prepare("INSERT INTO riwayat_peminjaman (id_user, id_buku, id_peminjaman, tanggal_pinjam, tanggal_batas) VALUES (?, ?, ?, ?, ?)");
$stmt2->bind_param("iiiss", $id_user, $id_buku, $id_peminjaman, $tanggal_pinjam, $tanggal_batas);

if ($stmt2->execute()) {
  header("Location: ../pages/resi.php");
  exit();
} else {
  echo "Gagal menyimpan riwayat: " . $stmt2->error;
}
?>
