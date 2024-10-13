<?php

require_once("config/Base.php");
require_once("config/Alert.php");

if (isset($_SESSION["project_cv_aquila_indonesia"]["users"])) {

  require_once("config/Auth.php");

  $pull_wishlist = "SELECT * FROM wishlist WHERE id_user='$id_user'";
  $store_wishlist = mysqli_query($conn, $pull_wishlist);
  $count_wishlist = mysqli_num_rows($store_wishlist);
  $pull_keranjang = "SELECT * FROM keranjang WHERE id_user='$id_user'";
  $store_keranjang = mysqli_query($conn, $pull_keranjang);
  $count_keranjang = mysqli_num_rows($store_keranjang);

  $keranjang = "SELECT keranjang.*, produk.image_produk, produk.nama_produk, produk.jumlah_produk, produk.harga, produk.deskripsi 
    FROM keranjang
    JOIN produk ON keranjang.id_produk = produk.id_produk
    WHERE keranjang.id_user = '$id_user'
  ";
  $view_keranjang = mysqli_query($conn, $keranjang);
  
  if(isset($_GET['kp'])){
    $id_kategori_produk = valid($conn, $_GET['kp']);
    $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
      FROM produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
      WHERE produk.id_kategori_produk = '$id_kategori_produk'
      ORDER BY produk.id_produk DESC LIMIT 8
    ";
  }else{
    $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
      FROM produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
      ORDER BY produk.id_produk DESC LIMIT 8
    ";
  }
  $view_produk = mysqli_query($conn, $produk);
  $view_produk_1 = mysqli_query($conn, $produk);
  $view_produk_2 = mysqli_query($conn, $produk);
  if (isset($_POST["add_keranjang"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (keranjang($conn, $validated_post, $action = 'insert', $id_user) > 0) {
      $message = "Produk ditambahkan ke keranjang anda.";
      $message_type = "success";
      alert($message, $message_type);
      if(isset($_GET['p'])){
        header("Location: produk-detail?p=".$_GET['p']);
      }else{
        header("Location: produk");
      }
      exit();
    }
  }
  if (isset($_POST["add_wishlist"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (wishlist($conn, $validated_post, $action = 'insert', $id_user) > 0) {
      $message = "Produk ditambahkan ke kerangjang anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: produk");
      exit();
    }
  }

  $kategori_produk = "SELECT * FROM kategori_produk";
  $view_kategori_produk = mysqli_query($conn, $kategori_produk);

  if (isset($_POST["add_ulasan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (ulasan($conn, $validated_post, $action = 'insert', $id_user) > 0) {
      $message = "Anda berhasil menambahkan ulasan ke produk " . $_POST['nama_produk'] . ".";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: produk-detail?p=".$_POST['id_produk']);
      exit();
    }
  }
}