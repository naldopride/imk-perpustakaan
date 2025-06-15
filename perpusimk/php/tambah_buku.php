<?php
include 'auth_admin.php'; // Hanya admin yang boleh akses
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap semua input dari form
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $halaman = intval($_POST['halaman']);
    $kategori = $_POST['kategori'];
    $location = $_POST['location'];
    $sipnosis = $_POST['sipnosis'];

    // Validasi dan upload gambar
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
        $namaFile = $_FILES['cover']['name'];
        $tmpName = $_FILES['cover']['tmp_name'];
        $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
        $namaBaru = uniqid() . '.' . strtolower($ext);
        $pathUpload = '../img/' . $namaBaru;

        // Cek ekstensi file
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        if (!in_array(strtolower($ext), $allowed_ext)) {
            die("Format gambar tidak didukung. Hanya JPG, JPEG, atau PNG.");
        }

        // Pindahkan file
        if (move_uploaded_file($tmpName, $pathUpload)) {
            // Simpan data ke database
            $stmt = $conn->prepare("INSERT INTO buku (judul, penulis, penerbit, halaman, kategori, location, sipnosis, cover) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $judul, $penulis, $penerbit, $halaman, $kategori, $location, $sipnosis, $namaBaru);

            if ($stmt->execute()) {
                header("Location: ../pages/dashboard.php?status=sukses#kelola-buku");
                exit();
            } else {
                echo "Gagal menyimpan ke database: " . $conn->error;
            }
        } else {
            echo "Gagal mengunggah cover.";
        }
    } else {
        echo "File cover tidak ditemukan atau error saat upload.";
    }
} else {
    echo "Akses tidak valid.";
}
?>
