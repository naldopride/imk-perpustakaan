<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $nama = $_POST['nama_pengguna'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    $sql = "INSERT INTO peminjaman (id_user, id_buku, nama_pengguna, alamat, email)
            VALUES ('$id_user', '$id_buku', '$nama', '$alamat', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Peminjaman berhasil disimpan.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
