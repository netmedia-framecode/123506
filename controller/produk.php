<?php
  
  require_once("../../config/Base.php");
  require_once("../../config/Auth.php");
  require_once("../../config/Alert.php");
  require_once("../../views/produk/redirect.php");
  
  $status_produk = "SELECT * FROM status_produk";
  $view_status_produk = mysqli_query($conn, $status_produk);
  if (isset($_POST["add_status_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_produk($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Status produk baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-produk");
      exit();
    }
  }
  if (isset($_POST["edit_status_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_produk($conn, $validated_post, $action = 'update') > 0) {
      $message = "Status produk " . $_POST['status_produkOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-produk");
      exit();
    }
  }
  if (isset($_POST["delete_status_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_produk($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Status produk " . $_POST['status_produk'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-produk");
      exit();
    }
  }
  
  $kategori_produk = "SELECT * FROM kategori_produk";
  $view_kategori_produk = mysqli_query($conn, $kategori_produk);
  if (isset($_POST["add_kategori_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kategori_produk($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Kategori produk baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-produk");
      exit();
    }
  }
  if (isset($_POST["edit_kategori_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kategori_produk($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kategori produk " . $_POST['kategori_produkOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-produk");
      exit();
    }
  }
  if (isset($_POST["delete_kategori_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kategori_produk($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Kategori produk " . $_POST['kategori_produk'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kategori-produk");
      exit();
    }
  }
  
  $produk = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
  ";
  $view_produk = mysqli_query($conn, $produk);
  if (isset($_POST["add_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (produk($conn, $validated_post, $action = 'insert', $name) > 0) {
      $message = "Produk baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: list-produk");
      exit();
    }
  }
  if (isset($_POST["edit_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (produk($conn, $validated_post, $action = 'update', $name) > 0) {
      $message = "Produk " . $_POST['nama_produkOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: list-produk");
      exit();
    }
  }
  if (isset($_POST["delete_produk"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (produk($conn, $validated_post, $action = 'delete', $name) > 0) {
      $message = "Produk " . $_POST['nama_produk'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: list-produk");
      exit();
    }
  }
  if (isset($_POST["add_wishlist"])) {
    // $validated_post = array_map(function ($value) use ($conn) {
    //   return valid($conn, $value);
    // }, $_POST);
    if (wishlist($conn, $_POST, $action = 'insert', $id_user) > 0) {
      $message = "Produk ditambahkan ke kerangjang anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ".$baseURL."views/pembelian/wishlist");
      exit();
    }
  }
  if (isset($_POST["add_keranjang"])) {
    // $validated_post = array_map(function ($value) use ($conn) {
    //   return valid($conn, $value);
    // }, $_POST);
    if (keranjang($conn, $_POST, $action = 'insert', $id_user) > 0) {
      $message = "Produk ditambahkan ke kerangjang anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ".$baseURL."views/pembelian/keranjang");
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
      header("Location: ".$baseURL."views/pembelian/tagihan");
      exit();
    }
  }