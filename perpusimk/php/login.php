<?php
include 'db.php';
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id_user, nama_pengguna, password FROM user WHERE nama_pengguna = ?");
    $stmt->bind_param("s", $nama_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Login pakai password_verify (karena di DB sudah hash)
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
            header("Location: /perpusimk/index.php"); // Pastikan path ke home/index.php benar
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nama pengguna tidak ditemukan.";
    }

    $stmt->close();
}
?>
