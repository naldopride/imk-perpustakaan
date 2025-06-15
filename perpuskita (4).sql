-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2025 pada 17.03
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpuskita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_pengguna`, `password`) VALUES
(1, 'admin1', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `arsip`
--

INSERT INTO `arsip` (`id`, `id_buku`, `id_user`) VALUES
(1, 1, 2),
(8, 1, 1),
(9, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `halaman` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `sipnosis` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `halaman`, `location`, `kategori`, `sipnosis`, `cover`) VALUES
(1, 'sang raja hutan', 'samira hadid', 'warner & spencer', 30, 'RAK : 1 Bagian Novel', 'Cerpen', 'Aku adalah anak dari seorang raja hutan ,ayah ku yang bernama musafa, ayah ku memberi namaku somba.', 'sang raja hutan.jpeg'),
(2, 'Doraemon Vol.5', 'Fujiko F. Fujio', 'Elex Media Komputindo', 100, 'RAK : 2 Bagian Komik', 'Komik', 'Petualangan lucu dan seru Doraemon, Nobita, dan kawan-kawan dengan alat-alat canggih dari masa depan. Di volume ini, kamu akan menemui kejadian-kejadian lucu saat Nobita menyalahgunakan alat Doraemon dan menghadapi konsekuensinya.', 'doraemon.jpg'),
(3, 'Ensiklopedia sejarah dunia', 'BIP', 'BIP', 458, 'Rak: 3 Bagian Ensiklopedia', 'Ensiklopedia', '*Ensiklopedia Sejarah Dunia* adalah buku referensi visual yang merangkum perjalanan peradaban manusia selama 12.000 tahun dengan ilustrasi, peta, dan data interaktif yang kaya dan informatif.\r\n', '684eb07dd6a39.jpg'),
(4, 'laskar pelangi', 'Andrea hirata', 'Bentang pustaka', 529, 'Rak : 5 Bagian Novel', 'Novel', 'Laskar Pelangi adalah novel yang mengangkat kisah nyata masa kecil Andrea Hirata di Belitung. Buku ini bercerita tentang 10 anak dari keluarga miskin yang bersekolah di SD Muhammadiyah Gantong—sebuah sekolah kecil yang hampir ditutup karena kekurangan mur', '684ed45867ab5.jpg'),
(5, 'Biografi Gus Dur: The Authorized Biography of Abdurrahman Wahid', 'Greg Barton', 'LKIS', 734, 'Rak : 1 Bagian Biografi', 'Biografi', 'Biografi Gus Dur karya Greg Barton mengisahkan perjalanan hidup Abdurrahman Wahid sebagai tokoh intelektual, pemimpin agama, dan Presiden Indonesia yang memperjuangkan pluralisme, demokrasi, dan kemanusiaan dengan penuh keteguhan dan humor.', '684ed601d65d1.jpg'),
(6, 'Jejak Rasa', 'Marganda Kristianto Purba Dkk', 'Surya aksara media', 122, 'Rak 2 : Bagian Antalogi', 'Antologi', 'Jejak rasa mengajakmu masuk ke dalam perjalanan emosi yang tak terucapkan, di mana setiap cerita menggali luka, cinta, dan kerinduan yang tersembunyi di dalam hati. Bukan sekadar kumpulan kata, antologi ini adalah alunan rasa yang mengikat jiwa dengan ken', '684ed6c253112.jpg'),
(7, 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 413, 'Rak : 1 Bagian Novel', 'Novel', 'Alif dan lima temannya bertemu di pesantren Madani dan tumbuh bersama dengan mimpi besar. Mereka belajar bahwa dengan tekad dan doa, mimpi sebesar apa pun bisa dicapai. Moto “man jadda wajada” menjadi semangat hidup mereka dalam mengejar masa depan.', '684eddb156ce3.jpg'),
(8, 'Dilan: Dia adalah Dilanku Tahun 1990', 'Pidi Baiq', 'Pastel Books', 698, 'Rak : 2 Bagian Novel', 'Novel', 'Milea mengenang masa SMA-nya yang manis dan penuh kenangan bersama Dilan, seorang anak motor yang unik dan jenaka. Cerita cinta mereka berkembang di tengah dinamika remaja Bandung tahun 90-an. Novel ini menghadirkan romansa yang ringan namun membekas.', '684eddfc81753.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `nama_pengguna`, `alamat`, `email`) VALUES
(14, 1, 3, 'droi', 'uaDB', 'adroi@gmail.com'),
(15, 1, 3, 'droi', 'uaDB', 'adroi@gmail.com'),
(16, 1, 3, 'droi', 'uaDB', 'adroi@gmail.com'),
(17, 1, 1, 'droi', 'uaDB', 'adroi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_peminjaman`
--

CREATE TABLE `riwayat_peminjaman` (
  `id_resi` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_batas` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_peminjaman`
--

INSERT INTO `riwayat_peminjaman` (`id_resi`, `id_peminjaman`, `id_user`, `id_buku`, `id_admin`, `denda`, `tanggal_pinjam`, `tanggal_batas`, `tanggal_kembali`) VALUES
(11, 16, 1, 3, 0, NULL, '2025-06-15', '2025-06-20', NULL),
(12, 17, 1, 1, 0, NULL, '2025-06-15', '2025-06-20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_pengguna`, `email`, `alamat`, `no_hp`, `password`) VALUES
(1, 'droi', 'adroi@gmail.com', 'uaDB', '12412', '$2y$10$x9t7Ap6mBkQ83sByqE2EKeOAJo8Xv1Yllz0gEo2h9Xhd3AU/mqq7u'),
(2, 'dodo', 'dodo@gmail.com', 'tdtftu', '43121', '$2y$10$hmtNx0D6FBBJvKp0B4Yaf.EHnD0Fa9l3o9Tf5nQznShOXT3vkng2q'),
(3, 'Naim', 'ahmadbahrunnaim46@gmail.com', 'Jalan Pramuka', '083173914075', '$2y$10$Xrg3gkaVsUCzzhJVqd/rHOani2/Bo6jAHckzLEtrhA2HEushAFcte');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `riwayat_peminjaman`
--
ALTER TABLE `riwayat_peminjaman`
  ADD PRIMARY KEY (`id_resi`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `riwayat_peminjaman`
--
ALTER TABLE `riwayat_peminjaman`
  MODIFY `id_resi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `arsip_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `riwayat_peminjaman`
--
ALTER TABLE `riwayat_peminjaman`
  ADD CONSTRAINT `riwayat_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
