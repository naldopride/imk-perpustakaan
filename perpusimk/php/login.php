<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $password = trim($_POST['password']);

    // Coba login sebagai user
    $stmt_user = $conn->prepare("SELECT id_user, nama_pengguna, password FROM user WHERE nama_pengguna = ?");
    $stmt_user->bind_param("s", $nama_pengguna);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
            $_SESSION['role'] = 'user';
            header("Location: /perpusimk/index.php");
            exit();
        }
    }

    // Coba login sebagai admin kalau bukan user
    $stmt_admin = $conn->prepare("SELECT id_admin, nama_pengguna, password FROM admin WHERE nama_pengguna = ?");
    $stmt_admin->bind_param("s", $nama_pengguna);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        $row = $result_admin->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
            $_SESSION['role'] = 'admin';
            header("Location: ../pages/dashboard.php");
            exit();
        }
    }

    // Gagal semua
    header("Location: ../pages/login.php?error=Nama pengguna atau password salah");
    exit();
}
?>
