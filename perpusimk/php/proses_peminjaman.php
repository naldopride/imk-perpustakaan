<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../pages/login.php");
  exit();
}

$id_user = $_SESSION['id_user'];
$nama = $_POST['nama_pengguna'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$id_buku = intval($_POST['id_buku']);

// Insert ke tabel peminjaman
$stmt = $conn->prepare("INSERT INTO peminjaman (id_user, id_buku, nama_pengguna, alamat, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $id_user, $id_buku, $nama, $alamat, $email);

if ($stmt->execute()) {
  // Tambahan: simpan juga ke tabel riwayat_peminjaman
  $id_admin = 1; // default admin
  $denda = 0;
  $tanggal_pinjam = date("Y-m-d H:i:s");
  $tanggal_batas = date("Y-m-d H:i:s", strtotime("+5 days"));
  $tgl_kembali = null;

  $stmt2 = $conn->prepare("INSERT INTO riwayat_peminjaman (id_user, id_admin, id_buku, denda, tanggal_pinjam, tanggal_batas, tanggal_kembali)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt2->bind_param("iiissss", $id_user, $id_admin, $id_buku, $denda, $tanggal_pinjam, $tanggal_batas, $tanggal_kembali);
  $stmt2->execute(); // insert ke riwayat

  header("Location: ../pages/koleksi.php?status=sukses");
  exit();
} else {
  echo "Gagal meminjam buku: " . $conn->error;
}
?>
