<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include '../php/db.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];
$id_buku = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_buku > 0) {
  // Cek apakah sudah ada data
  $cek = $conn->prepare("SELECT id FROM arsip WHERE id_user = ? AND id_buku = ?");
  $cek->bind_param("ii", $id_user, $id_buku);
  $cek->execute();
  $cek->store_result();

  if ($cek->num_rows == 0) {
    // Insert data baru
    $stmt = $conn->prepare("INSERT INTO arsip (id_user, id_buku) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_user, $id_buku);
    if ($stmt->execute()) {
      header("Location: ../pages/bukusimpan.php");
      exit();
    } else {
      echo "Gagal menyimpan buku: " . $conn->error;
    }
  } else {
    // Sudah ada, langsung redirect
    header("Location: ../pages/bukusimpan.php");
    exit();
  }
} else {

}
?>
