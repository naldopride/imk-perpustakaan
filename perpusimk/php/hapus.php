<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
include '../php/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];
$id_arsip = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cek dulu apakah data milik user
$stmt = $conn->prepare("SELECT * FROM arsip WHERE id = ? AND id_user = ?");
$stmt->bind_param("ii", $id_arsip, $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Hapus data
  $stmt = $conn->prepare("DELETE FROM arsip WHERE id = ? AND id_user = ?");
  $stmt->bind_param("ii", $id_arsip, $id_user);
  $stmt->execute();
}

// Kembali ke daftar buku simpan
header("Location: ../pages/bukusimpan.php");
exit();
?>
