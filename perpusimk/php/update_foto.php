<?php
include 'db.php';
session_start();

$nama = $_SESSION['nama_pengguna'];
$target_dir = "../img/profil/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $sql = "UPDATE user SET foto='" . basename($_FILES["foto"]["name"]) . "' WHERE nama_pengguna='$nama'";
    if ($conn->query($sql) === TRUE) {
        echo "Foto profil berhasil diperbarui.";
    } else {
        echo "Gagal menyimpan ke database.";
    }
} else {
    echo "Gagal upload file.";
}
?>
