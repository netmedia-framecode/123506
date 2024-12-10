-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Des 2024 pada 17.52
-- Versi server: 10.6.20-MariaDB-cll-lve
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zjxtorpv_123506`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) DEFAULT NULL,
  `model` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`, `model`) VALUES
(1, '4267763187.jpeg', '#4e73de', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `start` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `start`, `reply`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hallo', 'iya halo kak, ada yang bisa kami bantu?', '2024-10-12 15:36:56', '2024-10-13 10:52:05'),
(2, 4, 'Hallo, saya ingin tanya cara pembelian?', '', '2024-10-12 15:50:50', '2024-10-13 10:49:53'),
(3, 4, 'Apakah bisa dibantu?', 'tes', '2024-10-12 16:11:06', '2024-10-13 10:50:35'),
(4, 5, 'Hallo kaka', 'Halo kak, ad yang bisa kami bantu?', '2024-12-01 21:11:06', '2024-12-01 21:14:32'),
(5, 5, 'Hallo kaka', NULL, '2024-12-06 18:18:12', '2024-12-06 18:18:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL,
  `kategori_produk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori_produk`, `kategori_produk`) VALUES
(3, 'Minuman Herbal'),
(4, 'Makanan Herbal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_keranjang` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah_keranjang`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 1, '2024-10-10 17:56:07', '2024-10-10 17:56:07'),
(19, 2, 7, 1, '2024-10-15 12:56:21', '2024-10-15 12:56:21'),
(20, 4, 5, 1, '2024-12-01 17:26:33', '2024-12-01 17:26:33'),
(23, 4, 10, 1, '2024-12-01 18:30:58', '2024-12-01 18:30:58'),
(26, 5, 2, 1, '2024-12-02 13:05:01', '2024-12-02 13:05:01'),
(27, 5, 7, 1, '2024-12-09 09:48:22', '2024-12-09 09:48:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_status_pembelian` int(11) DEFAULT 3,
  `order_id` char(20) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `jumlah_produk` int(11) DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  `total_harga` char(20) GENERATED ALWAYS AS (`jumlah_produk` * `harga_satuan`) STORED,
  `tanggal_tagihan` datetime DEFAULT current_timestamp(),
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_user`, `id_produk`, `id_status_pembelian`, `order_id`, `token`, `jumlah_produk`, `harga_satuan`, `tanggal_tagihan`, `tanggal_pembayaran`, `metode_pembayaran`, `catatan`, `created_at`, `updated_at`) VALUES
(10, 4, 3, 1, '006744', '26ab790120589e919428e65c', 5, 27000.00, '2024-10-13 14:55:24', NULL, NULL, NULL, '2024-10-13 14:55:24', '2024-11-15 10:37:20'),
(20, 3, 3, 1, '618291', 'f00f1158f4ad3bd817defbe3', 1, 27000.00, '2024-10-13 20:57:02', NULL, NULL, NULL, '2024-10-13 20:57:02', '2024-10-13 20:21:00'),
(21, 3, 5, 3, '272925', '4adef1382b01c58396127a54', 1, 30000.00, '2024-10-13 20:57:06', NULL, NULL, NULL, '2024-10-13 20:57:06', '2024-10-13 20:57:06'),
(22, 4, 2, 3, '730878', '200791', 1, 45000.00, '2024-11-13 21:06:26', NULL, NULL, NULL, '2024-11-13 21:06:26', '2024-11-16 00:10:33'),
(23, 4, 2, 3, '976644', '705363', 1, 45000.00, '2024-11-15 10:19:51', NULL, NULL, NULL, '2024-11-15 10:19:51', '2024-11-16 00:11:29'),
(24, 4, 2, 3, '831735', '410701', 1, 45000.00, '2024-11-15 10:19:55', NULL, NULL, NULL, '2024-11-15 10:19:55', '2024-11-15 10:21:49'),
(25, 4, 7, 3, '091573', '410bcee6718fa9725fe55798', 1, 35000.00, '2024-11-15 10:28:01', NULL, NULL, NULL, '2024-11-15 10:28:01', '2024-11-15 10:28:01'),
(26, 4, 15, 3, '569129', 'ff2027539525f9c70bc20d1f', 1, 1800.00, '2024-11-16 00:06:08', NULL, NULL, NULL, '2024-11-16 00:06:08', '2024-11-16 00:06:08'),
(27, 4, 10, 3, '471898', '0f76207391c4020ff043115a', 1, 17000.00, '2024-11-18 08:44:59', NULL, NULL, NULL, '2024-11-18 08:44:59', '2024-11-18 08:44:59'),
(28, 4, 2, 3, '797050', '480639f95e1926cc4d3b1031', 2, 45000.00, '2024-11-18 15:04:19', NULL, NULL, NULL, '2024-11-18 15:04:19', '2024-11-18 15:04:19'),
(29, 4, 7, 3, '103635', '0cd820968661b01f72d64272', 1, 35000.00, '2024-11-19 10:46:34', NULL, NULL, NULL, '2024-11-19 10:46:34', '2024-11-19 10:46:34'),
(30, 4, 2, 3, '134357', '9e212936067fc74b16eca414', 1, 45000.00, '2024-11-28 13:45:51', NULL, NULL, NULL, '2024-11-28 13:45:51', '2024-11-28 13:45:51'),
(31, 4, 2, 3, '580695', 'fcbba6d1da397efb482a0bad', 12, 45000.00, '2024-12-01 17:27:36', NULL, NULL, NULL, '2024-12-01 17:27:36', '2024-12-01 17:27:36'),
(32, 4, 2, 3, '211733', '0dca59aea73b283194766f02', 1, 45000.00, '2024-12-01 17:28:29', NULL, NULL, NULL, '2024-12-01 17:28:29', '2024-12-01 17:28:29'),
(33, 4, 2, 3, '635068', 'a8e45078a939f1f29c993b51', 1, 45000.00, '2024-12-01 18:19:27', NULL, NULL, NULL, '2024-12-01 18:19:27', '2024-12-01 18:19:27'),
(34, 5, 10, 3, '598007', '775335', 1, 17000.00, '2024-12-01 19:14:42', NULL, NULL, NULL, '2024-12-01 19:14:42', '2024-12-01 19:17:10'),
(39, 5, 2, 1, '285045', '46ae6b7bbca087e400a7ea36', 1, 45000.00, '2024-12-02 13:07:06', NULL, NULL, NULL, '2024-12-02 13:07:06', '2024-12-03 00:59:13'),
(41, 5, 19, 3, '763177', '7ca4790e1e594ee22452e377', 1, 35000.00, '2024-12-06 14:06:30', NULL, NULL, NULL, '2024-12-06 14:06:30', '2024-12-06 14:06:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori_produk` int(11) DEFAULT NULL,
  `id_status_produk` int(11) DEFAULT NULL,
  `image_produk` varchar(50) DEFAULT 'default.png',
  `nama_produk` varchar(100) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_produk` int(11) DEFAULT NULL,
  `harga` char(10) DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori_produk`, `id_status_produk`, `image_produk`, `nama_produk`, `deskripsi`, `jumlah_produk`, `harga`, `tgl_kadaluarsa`, `created_at`, `updated_at`) VALUES
(2, 3, 3, '125539044.jpg', 'Kopi Almetira', 'Menghindari depresi, menyegarkan tubuh, mengurangi sakit kepala, membantu menurunkan berat badan, meredahkan perut kembung, memperlancar peredaran darah, menurunkan kolesterol.', 40, '35000', '2025-11-28', '2024-10-07 21:06:49', '2024-12-06 22:41:43'),
(3, 3, 3, '544523052.jpg', 'Jahe Merah Gula Aren', 'Meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol gula darah, mengontrol tekanan darah.', 50, '35000', '2025-12-31', '2024-10-08 00:03:59', '2024-12-06 22:26:15'),
(4, 3, 3, '4130152497.jpg', 'Jahe Merah Tanpa Gula', 'Mengontrol gula darah, meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol tekanan darah.', 35, '35000', '2025-12-30', '2024-10-08 00:04:35', '2024-12-06 22:39:36'),
(5, 3, 3, '1841062439.jpg', 'Jahe Putih', 'Anti kanker, mencegah penuaan, menurunkan kolesterol, mengontrol glukosa darah, menangalkan bakteri dan virus, meredahkan sakit otot, meredahkan nyer haid.', 50, '35000', '2025-10-22', '2024-10-08 00:07:42', '2024-12-06 22:32:59'),
(6, 3, 3, '1891193503.jpg', 'Kunyit Asam', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 15, '35000', '2024-12-19', '2024-10-08 00:09:32', '2024-12-06 22:34:21'),
(7, 3, 3, '3152380218.jpg', 'Kunyit Putih', 'Anti microba dan anti jamur, mengobati asam lambung, mencegah kanker, mengatasi masalah pencernaan, mencegah miom, penawar bisa ular, menghilang rasa sakit.', 75, '35000', '2025-08-26', '2024-10-08 00:10:14', '2024-12-06 22:36:00'),
(8, 3, 3, '1030878100.jpg', 'Temulawak', 'Meningkatkan daya tahan tubuh, anti kanker, menangkat bakteri dan virus, anti radang, meraangsang proses metabolisme, meningkatkan fungsi hati, mengeluarkan toksin dalam darah.', 60, '35000', '2025-07-28', '2024-10-08 00:10:47', '2024-12-06 22:37:24'),
(9, 3, 3, '2799743362.jpg', 'Jahe Merah', 'Meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol gula darah, mengontrol tekanan darah.', 50, '45000', '2025-11-05', '2024-11-15 10:42:05', '2024-12-10 09:57:47'),
(10, 4, 3, '1942487634.jpg', 'Gula Kacang Jahe', '', 20, '17000', '2025-11-04', '2024-11-15 11:06:59', '2024-12-06 22:55:05'),
(12, 4, 3, '1040229209.jpg', 'Kripik Pisang Gula Aren', '', 20, '17000', '2025-11-14', '2024-11-15 11:09:35', '2024-12-06 22:53:15'),
(14, 4, 3, '2777801039.jpg', 'Zara Cookies Mete', '', 15, '25000', '2024-12-07', '2024-11-15 11:12:27', '2024-12-06 22:48:55'),
(15, 4, 3, '3425124673.jpg', 'Zara Cookies Jahe Kacang', '', 10, '18000', '2024-12-07', '2024-11-15 14:57:24', '2024-12-06 22:47:21'),
(16, 4, 3, '3898163268.jpg', 'Kripik Tempe', '', 50, '17000', '2025-12-01', '2024-12-02 11:25:10', '2024-12-06 22:51:10'),
(17, 3, 3, '587568097.jpg', 'Kopi Stamina', '', 20, '35000', '2025-12-03', '2024-12-03 00:32:44', '2024-12-06 22:52:08'),
(18, 3, 4, '4116476156.jpg', 'Beras Kencur', 'Minuman berbahan dasar lengkuas diolah menjadi bubuk minuman herbal instan dan siap dikonsumsi. Komposisi; Lengkuas, Gula.', 0, '35000', '2026-12-06', '2024-12-06 13:45:45', '2024-12-06 22:54:10'),
(19, 3, 4, '1858941674.jpg', 'Kunyit Kuning', 'Minuman bubuk herbal instan yang diolah dari bahan-bahan pilihan. Komposisi; Kunyit kuning, gula pasir, kayu manis.', 5, '35000', '2026-12-06', '2024-12-06 13:47:14', '2024-12-06 22:50:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembelian`
--

CREATE TABLE `status_pembelian` (
  `id_status_pembelian` int(11) NOT NULL,
  `status_pembelian` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_pembelian`
--

INSERT INTO `status_pembelian` (`id_status_pembelian`, `status_pembelian`) VALUES
(1, 'Lunas'),
(2, 'Credit Card Success'),
(3, 'Pending'),
(4, 'Deny'),
(5, 'Expire'),
(6, 'Batal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_produk`
--

CREATE TABLE `status_produk` (
  `id_status_produk` int(11) NOT NULL,
  `status_produk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_produk`
--

INSERT INTO `status_produk` (`id_status_produk`, `status_produk`) VALUES
(3, 'Tersedia'),
(4, 'Belum Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_produk`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 3, 'tes', '2024-10-13 11:14:16', '2024-10-13 14:49:50'),
(2, 2, 2, 4, 'tess', '2024-10-13 14:44:20', '2024-10-13 14:44:20'),
(3, 3, 8, 4, 'tes', '2024-10-13 20:23:38', '2024-10-13 20:23:38'),
(4, 1, 3, 5, 'good', '2024-11-15 10:38:01', '2024-11-15 10:38:01'),
(5, 5, 2, 5, 'Minuman Herbal yang Sangat bagus dan bermanfaat bagi kesehatan', '2024-12-03 00:59:53', '2024-12-03 00:59:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `tlpn` char(12) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `tlpn`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'developer', 'default.svg', 'developer@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '08113827421', 'Jln. W.J Lalamentik No.95', '2024-10-06 20:18:20', '2024-10-06 20:18:20'),
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '081237171338', 'Penfui', '2024-10-06 20:18:20', '2024-10-06 20:18:20'),
(3, 3, 1, '2y10BN1nQYedGFRR1HseNTNBVuNVjyKXZA3bJKfhgCuhtPG82B4hznO', '651870', 'Arlan Butar Butar', 'default.svg', 'arlan270899@gmail.com', '$2y$10$b733G4k79p7PAvZh8ychEe59EWuuHESQaz/hn9qawb//UBO4fcPNm', '', '', '2024-10-07 00:00:07', '2024-10-07 00:00:18'),
(4, 3, 1, '2y10XaaHVlnZvEO5RWO19ghdOLTmdOvgYiu81YWdp6zN9eOoRajnVUPC', '824591', 'putri', 'default.svg', 'putriraki240800@gmail.com', '$2y$10$d2WXzAgMLceeFl4h/NFE1uT4rFzVA8L.RVuXYNYhs/6qIGvXrgkIC', NULL, NULL, '2024-10-12 15:49:49', '2024-10-12 15:50:14'),
(5, 3, 1, '2y1084f0jQRL0IVLbx8btqiuPxblfeEZQOFDjAqG7pWyfYw8GPFVDRW', '181249', 'Wenceslaus Hasan', 'default.svg', 'wenshasan00@gmail.com', '$2y$10$ez07iJdMuMbRKYDFGUj97uWaZ6JLHVAe305HoYsg0uIFtEBc3E1Di', '081237171338', 'Penfui, Jln Herman Yohanes', '2024-12-01 19:08:37', '2024-12-01 19:11:18');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 1, 6),
(4, 1, 7),
(5, 1, 8),
(6, 2, 5),
(7, 2, 6),
(8, 2, 7),
(9, 2, 8),
(10, 3, 5),
(11, 3, 6),
(12, 3, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5),
(4, 1, 4),
(5, 1, 3),
(6, 1, 10),
(7, 1, 9),
(8, 1, 7),
(9, 1, 6),
(11, 1, 13),
(13, 1, 11),
(14, 1, 16),
(15, 1, 15),
(16, 2, 5),
(17, 2, 4),
(18, 2, 3),
(19, 2, 10),
(20, 2, 9),
(24, 2, 13),
(26, 2, 11),
(27, 2, 16),
(28, 2, 15),
(29, 3, 5),
(30, 3, 10),
(31, 3, 9),
(32, 3, 7),
(33, 3, 6),
(34, 3, 16),
(35, 3, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `icon`, `menu`) VALUES
(1, 'bi bi-people', 'User Management'),
(5, 'bi bi-box-seam', 'Produk'),
(6, 'bi bi-bag', 'Pembelian'),
(7, 'bi bi-file-earmark-bar-graph', 'Laporan'),
(8, 'bi bi-headset', 'Dukungan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Developer'),
(2, 'Administrator'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`) VALUES
(1, 1, 1, 'Users', 'user-management/users'),
(2, 1, 1, 'Role', 'user-management/role'),
(3, 5, 1, 'Status Produk', 'produk/status-produk'),
(4, 5, 1, 'Kategori Produk', 'produk/kategori-produk'),
(5, 5, 1, 'List Produk', 'produk/list-produk'),
(6, 6, 1, 'Keranjang', 'pembelian/keranjang'),
(7, 6, 1, 'Wishlist', 'pembelian/wishlist'),
(9, 6, 1, 'Tagihan', 'pembelian/tagihan'),
(10, 6, 1, 'List Pembelian', 'pembelian/list-pembelian'),
(11, 7, 1, 'Produk', 'laporan/produk'),
(13, 7, 1, 'Pendapatan', 'laporan/pendapatan'),
(15, 8, 1, 'Chat', 'dukungan/chat'),
(16, 8, 1, 'Ulasan', 'dukungan/ulasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utilities`
--

CREATE TABLE `utilities` (
  `id` int(11) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `name_web` varchar(75) DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `utilities`
--

INSERT INTO `utilities` (`id`, `logo`, `name_web`, `keyword`, `description`, `author`) VALUES
(1, '604952327.png', 'CV Aquila Indonesia', '', '', 'Wenceslaus Hasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_produk`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2024-10-08 13:35:20', '2024-10-08 13:35:20'),
(3, 1, 5, '2024-10-08 13:35:36', '2024-10-08 13:35:36'),
(4, 1, 2, '2024-10-10 17:56:42', '2024-10-10 17:56:42'),
(5, 3, 4, '2024-10-13 20:38:09', '2024-10-13 20:38:09'),
(7, 4, 2, '2024-12-01 18:20:10', '2024-12-01 18:20:10'),
(8, 4, 10, '2024-12-01 18:30:21', '2024-12-01 18:30:21'),
(9, 5, 2, '2024-12-01 19:12:23', '2024-12-01 19:12:23'),
(11, 5, 10, '2024-12-02 10:22:58', '2024-12-02 10:22:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_status_pembelian` (`id_status_pembelian`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori_produk` (`id_kategori_produk`),
  ADD KEY `id_status_produk` (`id_status_produk`);

--
-- Indeks untuk tabel `status_pembelian`
--
ALTER TABLE `status_pembelian`
  ADD PRIMARY KEY (`id_status_pembelian`);

--
-- Indeks untuk tabel `status_produk`
--
ALTER TABLE `status_produk`
  ADD PRIMARY KEY (`id_status_produk`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `status_pembelian`
--
ALTER TABLE `status_pembelian`
  MODIFY `id_status_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_produk`
--
ALTER TABLE `status_produk`
  MODIFY `id_status_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_status_pembelian`) REFERENCES `status_pembelian` (`id_status_pembelian`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori_produk`) REFERENCES `kategori_produk` (`id_kategori_produk`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_status_produk`) REFERENCES `status_produk` (`id_status_produk`);

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`),
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
