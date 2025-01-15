-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Jan 2025 pada 17.15
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
(7, 3, 'halo', 'iya', '2025-01-14 18:49:09', '2025-01-14 19:12:02'),
(8, 3, NULL, 'sip', '2025-01-14 19:23:17', '2025-01-14 19:23:17'),
(9, 3, NULL, 'tes', '2025-01-14 19:23:23', '2025-01-14 19:23:23');

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
(58, 3, 2, 1, '148273', 'fade2a48023197b62401d61e', 10, 35000.00, '2025-01-14 19:45:35', NULL, NULL, NULL, '2025-01-14 19:45:35', '2025-01-14 19:45:53'),
(59, 5, 2, 3, '983159', 'b2209d18771d2740044d6f94', 30, 35000.00, '2025-01-14 20:01:44', NULL, NULL, NULL, '2025-01-14 20:01:44', '2025-01-14 20:01:44'),
(60, 5, 6, 1, '444991', 'd20eb899339810284f7640f1', 15, 35000.00, '2025-01-15 15:44:09', NULL, NULL, NULL, '2025-01-15 15:44:09', '2025-01-15 15:45:28'),
(61, 5, 19, 1, '750562', '8c65f180172fcbb4e163d069', 5, 35000.00, '2025-01-15 15:46:57', NULL, NULL, NULL, '2025-01-15 15:46:57', '2025-01-15 15:47:26'),
(62, 5, 23, 1, '191790', 'd32600bb7cfeb3025d0de98d', 20, 35000.00, '2025-01-15 15:54:23', NULL, NULL, NULL, '2025-01-15 15:54:23', '2025-01-15 15:55:01'),
(63, 5, 22, 1, '660052', 'beeaff4546c24038ed5c9621', 70, 35000.00, '2025-01-15 15:56:20', NULL, NULL, NULL, '2025-01-15 15:56:20', '2025-01-15 15:56:51');

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
(2, 3, 3, '125539044.jpg', 'Kopi Almetira', 'Menghindari depresi, menyegarkan tubuh, mengurangi sakit kepala, membantu menurunkan berat badan, meredahkan perut kembung, memperlancar peredaran darah, menurunkan kolesterol.', 30, '35000', '2025-11-28', '2024-10-07 21:06:49', '2025-01-14 19:45:53'),
(3, 3, 3, '544523052.jpg', 'Jahe Merah Gula Aren', 'Meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol gula darah, mengontrol tekanan darah.', 50, '35000', '2025-12-31', '2024-10-08 00:03:59', '2024-12-06 22:26:15'),
(4, 3, 3, '4130152497.jpg', 'Jahe Merah Tanpa Gula', 'Mengontrol gula darah, meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol tekanan darah.', 35, '35000', '2025-12-30', '2024-10-08 00:04:35', '2024-12-06 22:39:36'),
(5, 3, 3, '1841062439.jpg', 'Jahe Putih', 'Anti kanker, mencegah penuaan, menurunkan kolesterol, mengontrol glukosa darah, menangalkan bakteri dan virus, meredahkan sakit otot, meredahkan nyer haid.', 50, '35000', '2025-10-22', '2024-10-08 00:07:42', '2024-12-06 22:32:59'),
(6, 3, 3, '1891193503.jpg', 'Kunyit Asam', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 20, '35000', '2024-12-19', '2024-10-08 00:09:32', '2025-01-15 15:49:16'),
(9, 3, 3, '2799743362.jpg', 'Jahe Merah', 'Meningkatkan daya tahan tubuh, meningkatkan stamina, mengurangi kolesterol jahat, anti aging, mencegah kanker, menyehatkan otak, mencegah kanker usus, mencegah kebotakan, mengontrol gula darah, mengontrol tekanan darah.', 50, '45000', '2025-11-05', '2024-11-15 10:42:05', '2024-12-10 09:57:47'),
(10, 4, 3, '1942487634.jpg', 'Gula Kacang Jahe', '', 20, '17000', '2025-11-04', '2024-11-15 11:06:59', '2024-12-06 22:55:05'),
(12, 4, 3, '1040229209.jpg', 'Kripik Pisang Gula Aren', '', 20, '17000', '2025-11-14', '2024-11-15 11:09:35', '2024-12-06 22:53:15'),
(14, 4, 3, '2777801039.jpg', 'Zara Cookies Mete', '', 15, '25000', '2024-12-07', '2024-11-15 11:12:27', '2024-12-06 22:48:55'),
(15, 4, 3, '3425124673.jpg', 'Zara Cookies Jahe Kacang', '', 10, '18000', '2024-12-07', '2024-11-15 14:57:24', '2024-12-06 22:47:21'),
(16, 4, 3, '3898163268.jpg', 'Kripik Tempe', '', 50, '17000', '2025-12-01', '2024-12-02 11:25:10', '2024-12-06 22:51:10'),
(17, 3, 3, '587568097.jpg', 'Kopi Stamina', '', 20, '35000', '2025-12-03', '2024-12-03 00:32:44', '2024-12-06 22:52:08'),
(18, 3, 4, '4116476156.jpg', 'Beras Kencur', 'Minuman berbahan dasar lengkuas diolah menjadi bubuk minuman herbal instan dan siap dikonsumsi. Komposisi; Lengkuas, Gula.', 20, '35000', '2026-12-06', '2024-12-06 13:45:45', '2025-01-15 15:49:02'),
(19, 3, 4, '1858941674.jpg', 'Kunyit Kuning', 'Minuman bubuk herbal instan yang diolah dari bahan-bahan pilihan. Komposisi; Kunyit kuning, gula pasir, kayu manis.', 10, '35000', '2026-12-06', '2024-12-06 13:47:14', '2025-01-15 15:49:33'),
(22, 3, 3, '3195073283.jpg', 'Temulawak', 'Meningkatkan daya tahan tubuh, anti kanker, menangkat bakteri dan virus, anti radang, meraangsang proses metabolisme, meningkatkan fungsi hati, mengeluarkan toksin dalam darah.', 0, '35000', '2026-12-15', '2025-01-15 15:41:32', '2025-01-15 15:56:51'),
(23, 3, 3, '1736045098.jpg', 'Kunyit putih', '', 0, '35000', '2025-01-15', '2025-01-15 15:53:06', '2025-01-15 15:55:01');

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
(7, 3, 3, 4, 'enak', '2025-01-14 18:48:51', '2025-01-14 18:48:51');

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
(3, 3, 1, '2y10BN1nQYedGFRR1HseNTNBVuNVjyKXZA3bJKfhgCuhtPG82B4hznO', '651870', 'Arlan Butar Butar', 'default.svg', 'arlan270899@gmail.com', '$2y$10$b733G4k79p7PAvZh8ychEe59EWuuHESQaz/hn9qawb//UBO4fcPNm', '08113827421', 'Jln. W.J Lalamentik no.95', '2024-10-07 00:00:07', '2024-10-07 00:00:18'),
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
(7, 6, 2, 'Wishlist', 'wishlist'),
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
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `status_pembelian`
--
ALTER TABLE `status_pembelian`
  MODIFY `id_status_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_produk`
--
ALTER TABLE `status_produk`
  MODIFY `id_status_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
