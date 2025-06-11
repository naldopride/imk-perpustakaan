<?php
// regis.php

// Panggil file koneksi database
include 'db.php';

// Inisialisasi variabel error
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $email = trim($_POST['email']);
    $alamat = trim($_POST['alamat']);
    $no_hp = trim($_POST['no_hp']);
    $password = trim($_POST['password']);
    $konfirmasi_password = trim($_POST['konfirmasi_password']);

    // Validasi input
    if (empty($nama_pengguna) || empty($email) || empty($alamat) || empty($no_hp) || empty($password) || empty($konfirmasi_password)) {
        $error = 'Semua field harus diisi!';
    } elseif ($password !== $konfirmasi_password) {
        $error = 'Password dan konfirmasi password tidak sama!';
    } else {
        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT id_user FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Email sudah terdaftar. Gunakan email lain!';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert ke database
            $stmt = $conn->prepare("INSERT INTO user (nama_pengguna, email, alamat, no_hp, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nama_pengguna, $email, $alamat, $no_hp, $hashed_password);

            if ($stmt->execute()) {
                $success = 'Registrasi berhasil! Silakan login.';
            } else {
                $error = 'Registrasi gagal: ' . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>