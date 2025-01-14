<?php
  
  require_once("../../config/Base.php");
  require_once("../../config/Auth.php");
  require_once("../../config/Alert.php");
  require_once("../../views/laporan/redirect.php");

  $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
  ";
  $view_produk = mysqli_query($conn, $produk);
  if (isset($_POST["print_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (produk($conn, $validated_post, $action = 'print', $name = $name) > 0) {
      $message = "Produk berhasil di print.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: print-produk");
      exit();
    }
  }
  if (isset($_POST["export_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (produk($conn, $validated_post, $action = 'export', $name = $name) > 0) {
      $message = "Produk berhasil di export.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: export-produk");
      exit();
    }
  }

  $pembelian = "SELECT pembelian.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, status_pembelian.status_pembelian, kategori_produk.kategori_produk
    FROM pembelian
    JOIN users ON pembelian.id_user = users.id_user
    JOIN produk ON pembelian.id_produk = produk.id_produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
    WHERE pembelian.id_status_pembelian = '1'
  ";
  $view_pembelian = mysqli_query($conn, $pembelian);
  if (isset($_POST["export_pendapatan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pembelian($conn, $validated_post, $action = 'export', $name = $name) > 0) {
      $message = "Pembelian berhasil di export.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: export-pendapatan");
      exit();
    }
  }
  if (isset($_POST["print_pendapatan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pembelian($conn, $validated_post, $action = 'print', $name = $name) > 0) {
      $message = "Pendapatan berhasil di print.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: print-pendapatan");
      exit();
    }
  }