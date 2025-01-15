<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$pull_produk = "SELECT * FROM produk";
$store_produk = mysqli_query($conn, $pull_produk);
$count_produk = mysqli_num_rows($store_produk);
$pull_pembelian = "SELECT * FROM pembelian";
$store_pembelian = mysqli_query($conn, $pull_pembelian);
$count_pembelian = mysqli_num_rows($store_pembelian);
$pull_users = "SELECT * FROM users WHERE id_role='3'";
$store_users = mysqli_query($conn, $pull_users);
$count_users = mysqli_num_rows($store_users);
$pull_chat = "SELECT * FROM chat";
$store_chat = mysqli_query($conn, $pull_chat);
$count_chat = mysqli_num_rows($store_chat);
$pull_ulasan = "SELECT * FROM ulasan";
$store_ulasan = mysqli_query($conn, $pull_ulasan);
$count_ulasan = mysqli_num_rows($store_ulasan);

$pull_lunas = "SELECT * FROM pembelian WHERE id_status_pembelian='1'";
$store_lunas = mysqli_query($conn, $pull_lunas);
$count_lunas = mysqli_num_rows($store_lunas);
$pull_pending = "SELECT * FROM pembelian WHERE id_status_pembelian='3'";
$store_pending = mysqli_query($conn, $pull_pending);
$count_pending = mysqli_num_rows($store_pending);
$pull_deny = "SELECT * FROM pembelian WHERE id_status_pembelian='4'";
$store_deny = mysqli_query($conn, $pull_deny);
$count_deny = mysqli_num_rows($store_deny);
$pull_expire = "SELECT * FROM pembelian WHERE id_status_pembelian='5'";
$store_expire = mysqli_query($conn, $pull_expire);
$count_expire = mysqli_num_rows($store_expire);

if($id_role<=2){
  $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
  ";
}else if($id_role==3){
  $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
    WHERE produk.jumlah_produk != 0
  ";
}
$view_produk = mysqli_query($conn, $produk);
if (isset($_POST["add_keranjang"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (keranjang($conn, $_POST, $action = 'insert', $id_user) > 0) {
    $message = "Produk ditambahkan ke kerangjang anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: pembelian/keranjang");
    exit();
  }
}
if (isset($_POST["add_tagihan"])) {
  // $validated_post = array_map(function ($value) use ($conn) {
  //   return valid($conn, $value);
  // }, $_POST);
  if (tagihan($conn, $_POST, $action = 'insert', $id_user) > 0) {
    $message = "Produk ditambahkan ke kerangjang anda.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: pembelian/tagihan");
    exit();
  }
}

if($id_role <= 2){
  $list_pembelian = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
    FROM pembelian
    JOIN users ON pembelian.id_user = users.id_user
    JOIN produk ON pembelian.id_produk = produk.id_produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
  ";
}else if($id_role == 3){
  $list_pembelian = "SELECT pembelian.*, produk.image_produk, produk.nama_produk, produk.jumlah_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
    FROM pembelian
    JOIN produk ON pembelian.id_produk = produk.id_produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
    WHERE pembelian.id_user = '$id_user'
  ";
}
$view_list_pembelian = mysqli_query($conn, $list_pembelian);