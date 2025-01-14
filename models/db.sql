-- Active: 1721730379871@@127.0.0.1@3306@cv_aquila_indonesia
CREATE TABLE
  utilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    logo VARCHAR(50),
    name_web VARCHAR(75),
    keyword TEXT,
    description TEXT,
    author VARCHAR(50)
  );

CREATE TABLE
  auth (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(50),
    bg VARCHAR(35),
    model INT DEFAULT 2
  );

CREATE TABLE
  user_role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(35)
  );

INSERT INTO
  user_role (role)
VALUES
  ('Administrator'),
  ('Owner'),
  ('Member');

CREATE TABLE
  user_status (
    id_status INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(35)
  );

INSERT INTO
  user_status (status)
VALUES
  ('Active'),
  ('No Active');

CREATE TABLE
  users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    id_role INT,
    id_active INT,
    en_user VARCHAR(75),
    token CHAR(6),
    name VARCHAR(100),
    image VARCHAR(100),
    email VARCHAR(75),
    password VARCHAR(100),
    tlpn CHAR(12),
    alamat CHAR(225),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_role) REFERENCES user_role (id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
    FOREIGN KEY (id_active) REFERENCES user_status (id_active) ON UPDATE NO ACTION ON DELETE NO ACTION
  );

CREATE TABLE
  user_menu (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    menu VARCHAR(50)
  );

CREATE TABLE
  user_sub_menu (
    id_sub_menu INT AUTO_INCREMENT PRIMARY KEY,
    id_menu INT,
    id_active INT,
    title VARCHAR(50),
    url VARCHAR(50),
    FOREIGN KEY (id_menu) REFERENCES user_menu (id_menu) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_active) REFERENCES user_status (id_active) ON UPDATE NO ACTION ON DELETE NO ACTION
  );

CREATE TABLE
  user_access_menu (
    id_access_menu INT AUTO_INCREMENT PRIMARY KEY,
    id_role INT,
    id_menu INT,
    FOREIGN KEY (id_role) REFERENCES user_role (id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
    FOREIGN KEY (id_menu) REFERENCES user_menu (id_menu) ON UPDATE CASCADE ON DELETE CASCADE
  );

CREATE TABLE
  user_access_sub_menu (
    id_access_sub_menu INT AUTO_INCREMENT PRIMARY KEY,
    id_role INT,
    id_sub_menu INT,
    FOREIGN KEY (id_role) REFERENCES user_role (id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
    FOREIGN KEY (id_sub_menu) REFERENCES user_sub_menu (id_sub_menu) ON UPDATE CASCADE ON DELETE CASCADE
  );

CREATE TABLE
  status_produk (
    id_status_produk INT AUTO_INCREMENT PRIMARY KEY,
    status_produk VARCHAR(50)
  );

CREATE TABLE
  kategori_produk (
    id_kategori_produk INT AUTO_INCREMENT PRIMARY KEY,
    kategori_produk VARCHAR(50)
  );

CREATE TABLE
  produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori_produk INT,
    id_status_produk INT,
    image_produk VARCHAR(50) DEFAULT 'default.jpg',
    nama_produk VARCHAR(100),
    deskripsi TEXT,
    jumlah_produk INT,
    harga CHAR(10),
    tgl_kadaluarsa DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori_produk) REFERENCES kategori_produk (id_kategori_produk) ON UPDATE NO ACTION ON DELETE NO ACTION,
    FOREIGN KEY (id_status_produk) REFERENCES status_produk (id_status_produk) ON UPDATE NO ACTION ON DELETE NO ACTION
  );

CREATE TABLE
  keranjang (
    id_keranjang INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_produk INT,
    jumlah_keranjang INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk (id_produk) ON UPDATE CASCADE ON DELETE CASCADE
  );

CREATE TABLE
  wishlist (
    id_wishlist INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_produk INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk (id_produk) ON UPDATE CASCADE ON DELETE CASCADE
  );

CREATE TABLE
  status_pembelian (
    id_status_pembelian INT AUTO_INCREMENT PRIMARY KEY,
    status_pembelian VARCHAR(50)
  );

INSERT INTO
  status_pembelian (status_pembelian)
VALUES
  ('Lunas'),
  ('Credit Card Success'),
  ('Pending'),
  ('Deny'),
  ('Expire');

CREATE TABLE
  pembelian (
    id_pembelian INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_produk INT,
    id_status_pembelian INT,
    order_id CHAR(20),
    token VARCHAR(50),
    jumlah_produk INT,
    harga_satuan DECIMAL(10, 2),
    total_harga DECIMAL(10, 2) AS (jumlah_produk * harga_satuan) STORED,
    tanggal_tagihan DATETIME DEFAULT CURRENT_TIMESTAMP,
    tanggal_pembayaran DATETIME,
    metode_pembayaran VARCHAR(50),
    catatan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk (id_produk) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_status_pembelian) REFERENCES status_pembelian (id_status_pembelian) ON UPDATE NO ACTION ON DELETE NO ACTION
  );

CREATE TABLE
  chat (
    id_chat INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    start TEXT,
    reply TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE
  );

CREATE TABLE
  ulasan (
    id_ulasan INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_produk INT,
    rating INT,
    ulasan TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_produk) REFERENCES produk (id_produk) ON UPDATE CASCADE ON DELETE CASCADE
  );