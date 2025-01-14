<?php
  
  require_once("../../config/Base.php");
  require_once("../../config/Auth.php");
  require_once("../../config/Alert.php");
  require_once("../../views/dukungan/redirect.php");
  
  if($id_role<=2){
    $chat = "SELECT chat.*, users.image, users.name
         FROM chat
         JOIN users ON chat.id_user = users.id_user
         WHERE chat.updated_at = (
             SELECT MAX(c.updated_at)
             FROM chat c
             WHERE c.id_user = chat.id_user
         )
         ORDER BY chat.updated_at DESC
    ";
  }else if($id_role==3){
    $chat = "SELECT chat.*, users.image, users.name FROM chat JOIN users ON chat.id_user = users.id_user WHERE chat.id_user='$id_user'";
  }
  $view_chat = mysqli_query($conn, $chat);
  if (isset($_POST["send_message"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (chat($conn, $validated_post, $action = 'insert', $id_user) > 0) {
      $message = "Pesan berhasil terkirim, silakan tunggu balasan dari admin.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: chat");
      exit();
    }
  }
  if (isset($_POST["update_message"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (chat($conn, $validated_post, $action = 'update', $id_user) > 0) {
      header("Location: chat?u=".$_POST['id_user']);
      exit();
    }
  }

  if($id_role<=2){
  $ulasan = "SELECT ulasan.*, users.image, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, kategori_produk.kategori_produk 
    FROM ulasan 
    JOIN users ON ulasan.id_user = users.id_user 
    JOIN produk ON ulasan.id_produk = produk.id_produk 
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    ORDER BY ulasan.id_ulasan DESC
  ";
  }else if($id_role==3){
    $ulasan = "SELECT ulasan.*, produk.image_produk, produk.nama_produk, kategori_produk.kategori_produk 
      FROM ulasan 
      JOIN produk ON ulasan.id_produk = produk.id_produk 
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      WHERE ulasan.id_user = '$id_user'
      ORDER BY ulasan.id_ulasan DESC
    ";
  }
  $view_ulasan = mysqli_query($conn, $ulasan);