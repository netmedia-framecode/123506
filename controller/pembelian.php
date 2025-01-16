<?php

require_once("../../config/Base.php");
require_once("../../config/Auth.php");
require_once("../../config/Alert.php");
require_once("../../views/pembelian/redirect.php");

$produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
    WHERE produk.jumlah_produk > 0
  ";
$view_produk = mysqli_query($conn, $produk);

$keranjang = "SELECT keranjang.*, produk.image_produk, produk.nama_produk, produk.jumlah_produk, produk.harga, produk.deskripsi 
    FROM keranjang
    JOIN produk ON keranjang.id_produk = produk.id_produk
    WHERE keranjang.id_user = '$id_user'
  ";
$view_keranjang = mysqli_query($conn, $keranjang);
if (isset($_POST["add_keranjang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (keranjang($conn, $validated_post, $action = 'insert', $id_user) > 0) {
    $message = "Produk ditambahkan ke keranjang anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: keranjang");
    exit();
  }
}
if (isset($_POST["delete_keranjang"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (keranjang($conn, $_POST, $action = 'delete', $id_user) > 0) {
    $message = "Produk " . $_POST['nama_produk'] . " berhasil dihapus dari keranjang anda.";
    $message_type = "success-delete";
    alert($message, $message_type);
    header("Location: keranjang");
    exit();
  }
}

if ($id_role <= 2) {
  $tagihan = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
      FROM pembelian
      JOIN users ON pembelian.id_user = users.id_user
      JOIN produk ON pembelian.id_produk = produk.id_produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
      WHERE pembelian.id_status_pembelian != '1'
    ";
} else if ($id_role == 3) {
  $tagihan = "SELECT pembelian.*, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
      FROM pembelian
      JOIN produk ON pembelian.id_produk = produk.id_produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
      WHERE pembelian.id_user = '$id_user'
      AND pembelian.id_status_pembelian != '1'
    ";
}
$view_tagihan = mysqli_query($conn, $tagihan);
if (isset($_POST["add_one_tagihan"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (tagihan($conn, $_POST, $action = 'insert_one', $id_user) > 0) {
    $message = "Produk berhasil ditambahkan ke tagihan anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tagihan");
    exit();
  }
}
if (isset($_POST["add_tagihan"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (tagihan($conn, $_POST, $action = 'insert', $id_user) > 0) {
    $message = "Produk berhasil ditambahkan ke tagihan anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tagihan");
    exit();
  }
}
if (isset($_POST["edit_tagihan"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (tagihan($conn, $_POST, $action = 'update', $id_user) > 0) {
    $message = "Produk " . $_POST['nama_produk'] . " berhasil menambahkan catatan dari tagihan anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tagihan");
    exit();
  }
}
if (isset($_POST["delete_tagihan"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (tagihan($conn, $validated_post, $action = 'delete', $id_user) > 0) {
    $message = "Produk " . $_POST['nama_produk'] . " berhasil dihapus dari tagihan anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tagihan");
    exit();
  }
}
if (isset($_POST["pay"])) {
  $id_pembelian = valid($conn, $_POST['id_pembelian']);
  $jumlah_produk = valid($conn, $_POST['jumlah_produk']);
  $check_data_produk = "SELECT produk.jumlah_produk FROM produk JOIN pembelian ON produk.id_produk = pembelian.id_produk WHERE pembelian.id_pembelian = '$id_pembelian'";
  $view_check_data_produk = mysqli_query($conn, $check_data_produk);
  $data_produk = mysqli_fetch_assoc($view_check_data_produk);
  if ($data_produk['jumlah_produk'] < $jumlah_produk) {
    if ($data_produk['jumlah_produk'] == 0) {
      $sql = "DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'";
      mysqli_query($conn, $sql);
      $message = "Produk " . $_POST['nama_produk'] . " yang anda beli sudah tidak tersedia. Anda bisa membeli ulang produk yang masih tersedia.";
    } else {
      $sql = "UPDATE pembelian SET jumlah_produk = '$data_produk[jumlah_produk]' WHERE id_pembelian = '$id_pembelian'";
      mysqli_query($conn, $sql);
      $message = "Produk " . $_POST['nama_produk'] . " yang anda beli tampaknya jumlah pembelian melebihi stok yang ada yaitu " . $data_produk['jumlah_produk'] . " pcs. Anda bisa membeli ulang produk ini dengan stok yang tersedia.";
    }
    $message_type = "danger";
    alert($message, $message_type);
    header("Location: tagihan");
    exit();
  } else {
    $_SESSION['detail_pembelian'] = ['id_pembelian' => $id_pembelian];
    header("Location: pay");
    exit();
  }
}

if ($id_role <= 2) {
  $pembelian = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
      FROM pembelian
      JOIN users ON pembelian.id_user = users.id_user
      JOIN produk ON pembelian.id_produk = produk.id_produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
      WHERE pembelian.id_status_pembelian = '1'
    ";
} else if ($id_role == 3) {
  $pembelian = "SELECT pembelian.*, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
      FROM pembelian
      JOIN produk ON pembelian.id_produk = produk.id_produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
      WHERE pembelian.id_user = '$id_user'
      AND pembelian.id_status_pembelian = '1'
    ";
}
$view_pembelian = mysqli_query($conn, $pembelian);

if (isset($_POST["add_ulasan"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (ulasan($conn, $validated_post, $action = 'insert', $id_user) > 0) {
    $message = "Anda berhasil menambahkan ulasan ke produk " . $_POST['nama_produk'] . ".";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: list-pembelian");
    exit();
  }
}
