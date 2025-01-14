-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Okt 2024 pada 13.00
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv_aquila_indonesia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int NOT NULL,
  `image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bg` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` int DEFAULT '2'
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
  `id_chat` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `start` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `start`, `reply`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hallo', 'iya halo kak, ada yang bisa kami bantu?', '2024-10-12 15:36:56', '2024-10-13 10:52:05'),
(2, 4, 'Hallo, saya ingin tanya cara pembelian?', '', '2024-10-12 15:50:50', '2024-10-13 10:49:53'),
(3, 4, 'Apakah bisa dibantu?', 'tes', '2024-10-12 16:11:06', '2024-10-13 10:50:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int NOT NULL,
  `kategori_produk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_keranjang` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `jumlah_keranjang` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah_keranjang`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 1, '2024-10-10 17:56:07', '2024-10-10 17:56:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `id_status_pembelian` int DEFAULT '3',
  `order_id` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_produk` int DEFAULT NULL,
  `harga_satuan` decimal(10,2) DEFAULT NULL,
  `total_harga` char(20) COLLATE utf8mb4_general_ci GENERATED ALWAYS AS ((`jumlah_produk` * `harga_satuan`)) STORED,
  `tanggal_tagihan` datetime DEFAULT CURRENT_TIMESTAMP,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_user`, `id_produk`, `id_status_pembelian`, `order_id`, `token`, `jumlah_produk`, `harga_satuan`, `tanggal_tagihan`, `tanggal_pembayaran`, `metode_pembayaran`, `catatan`, `created_at`, `updated_at`) VALUES
(10, 4, 3, 3, '006744', '26ab790120589e919428e65c', 5, 27000.00, '2024-10-13 14:55:24', NULL, NULL, NULL, '2024-10-13 14:55:24', '2024-10-13 14:55:24'),
(20, 3, 3, 3, '618291', 'f00f1158f4ad3bd817defbe3', 1, 27000.00, '2024-10-13 20:57:02', NULL, NULL, NULL, '2024-10-13 20:57:02', '2024-10-13 20:57:02'),
(21, 3, 5, 3, '272925', '4adef1382b01c58396127a54', 1, 30000.00, '2024-10-13 20:57:06', NULL, NULL, NULL, '2024-10-13 20:57:06', '2024-10-13 20:57:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `id_kategori_produk` int DEFAULT NULL,
  `id_status_produk` int DEFAULT NULL,
  `image_produk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'default.png',
  `nama_produk` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_produk` int DEFAULT NULL,
  `harga` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori_produk`, `id_status_produk`, `image_produk`, `nama_produk`, `deskripsi`, `jumlah_produk`, `harga`, `tgl_kadaluarsa`, `created_at`, `updated_at`) VALUES
(2, 3, 3, '1914447294.jpg', 'Kopi Jahe Merah', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad similique commodi delectus itaque. Repellendus, tenetur maxime accusantium commodi dolore incidunt, voluptate ullam atque quasi dignissimos excepturi eum pariatur veniam eligendi. Nobis adipisci aspernatur molestias excepturi, aperiam ab possimus, ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 10, '15000', '2024-12-28', '2024-10-07 21:06:49', '2024-10-08 10:42:20'),
(3, 3, 3, '1881483011.jpg', 'Jahe Merah Gula Aren', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad similique commodi delectus itaque. Repellendus, tenetur maxime accusantium commodi dolore incidunt, voluptate ullam atque quasi dignissimos excepturi eum pariatur veniam eligendi. Nobis adipisci aspernatur molestias excepturi, aperiam ab possimus, ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 50, '27000', '2024-12-31', '2024-10-08 00:03:59', '2024-10-08 10:44:08'),
(4, 3, 3, '1093355149.jpg', 'Jahe Merah Tanpa Gula', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 35, '20000', '2024-11-30', '2024-10-08 00:04:35', '2024-10-08 10:44:27'),
(5, 3, 3, '3575033032.jpg', 'Jahe Putih', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad similique commodi delectus itaque. Repellendus, tenetur maxime accusantium commodi dolore incidunt, voluptate ullam atque quasi dignissimos excepturi eum pariatur veniam eligendi. Nobis adipisci aspernatur molestias excepturi, aperiam ab possimus,', 50, '30000', '2024-11-28', '2024-10-08 00:07:42', '2024-10-08 10:44:21'),
(6, 3, 3, '614136412.jpg', 'Kunyit Asam', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 15, '15000', '2024-12-19', '2024-10-08 00:09:32', '2024-10-13 19:18:18'),
(7, 3, 3, '1736045098.jpg', 'Kunyit Putih', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 75, '15000', '2024-12-26', '2024-10-08 00:10:14', '2024-10-13 19:18:22'),
(8, 3, 3, '2789288187.jpg', 'Temulawak', 'ex ducimus molestiae numquam mollitia quisquam maxime dolores quae aliquam iusto sint?', 100, '24000', '2024-12-28', '2024-10-08 00:10:47', '2024-10-13 19:18:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembelian`
--

CREATE TABLE `status_pembelian` (
  `id_status_pembelian` int NOT NULL,
  `status_pembelian` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_status_produk` int NOT NULL,
  `status_produk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_ulasan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `ulasan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_produk`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 3, 'tes', '2024-10-13 11:14:16', '2024-10-13 14:49:50'),
(2, 2, 2, 4, 'tess', '2024-10-13 14:44:20', '2024-10-13 14:44:20'),
(3, 3, 8, 4, 'tes', '2024-10-13 20:23:38', '2024-10-13 20:23:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_active` int DEFAULT '2',
  `en_user` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'default.svg',
  `email` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tlpn` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `tlpn`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'developer', 'default.svg', 'developer@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '08113827421', 'Jln. W.J Lalamentik No.95', '2024-10-06 20:18:20', '2024-10-06 20:18:20'),
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '', '', '2024-10-06 20:18:20', '2024-10-06 20:18:20'),
(3, 3, 1, '2y10BN1nQYedGFRR1HseNTNBVuNVjyKXZA3bJKfhgCuhtPG82B4hznO', '651870', 'Arlan Butar Butar', 'default.svg', 'arlan270899@gmail.com', '$2y$10$b733G4k79p7PAvZh8ychEe59EWuuHESQaz/hn9qawb//UBO4fcPNm', '', '', '2024-10-07 00:00:07', '2024-10-07 00:00:18'),
(4, 3, 1, '2y10XaaHVlnZvEO5RWO19ghdOLTmdOvgYiu81YWdp6zN9eOoRajnVUPC', '824591', 'putri', 'default.svg', 'putriraki240800@gmail.com', '$2y$10$d2WXzAgMLceeFl4h/NFE1uT4rFzVA8L.RVuXYNYhs/6qIGvXrgkIC', NULL, NULL, '2024-10-12 15:49:49', '2024-10-12 15:50:14');

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
  `id_access_menu` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL
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
  `id_access_sub_menu` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `id_sub_menu` int DEFAULT NULL
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
  `id_menu` int NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_role` int NOT NULL,
  `role` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_status` int NOT NULL,
  `status` varchar(35) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id_sub_menu` int NOT NULL,
  `id_menu` int DEFAULT NULL,
  `id_active` int DEFAULT '2',
  `title` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `id` int NOT NULL,
  `logo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_web` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keyword` text COLLATE utf8mb4_general_ci,
  `description` text COLLATE utf8mb4_general_ci,
  `author` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `utilities`
--

INSERT INTO `utilities` (`id`, `logo`, `name_web`, `keyword`, `description`, `author`) VALUES
(1, '1422518582.png', 'CV Aquila Indonesia', '', '', 'Wenceslaus Hasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_produk`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2024-10-08 13:35:20', '2024-10-08 13:35:20'),
(3, 1, 5, '2024-10-08 13:35:36', '2024-10-08 13:35:36'),
(4, 1, 2, '2024-10-10 17:56:42', '2024-10-10 17:56:42'),
(5, 3, 4, '2024-10-13 20:38:09', '2024-10-13 20:38:09');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `status_pembelian`
--
ALTER TABLE `status_pembelian`
  MODIFY `id_status_pembelian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_produk`
--
ALTER TABLE `status_produk`
  MODIFY `id_status_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
