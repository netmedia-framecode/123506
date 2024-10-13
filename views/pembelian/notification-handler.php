<?php
require_once("../../controller/pembelian.php");

$transaction = valid($conn, $_GET['transaction_status']);
$order_id = valid($conn, $_GET['order_id']);
$token = generateToken(12);

if ($transaction == 'settlement') {
  $sql = "UPDATE pembelian SET id_status_pembelian='1' WHERE token='$order_id'";
  mysqli_query($conn, $sql);
  header("Location: list-pembelian");
  exit;
} else if ($transaction == 'pending') {
  $sql = "UPDATE pembelian SET id_status_pembelian='3', token='$token' WHERE token='$order_id'";
  mysqli_query($conn, $sql);
  header("Location: tagihan");
  exit;
} else if ($transaction == 'deny') {
  $sql = "UPDATE pembelian SET id_status_pembelian='4', token='$token' WHERE token='$order_id'";
  mysqli_query($conn, $sql);
  header("Location: tagihan");
  exit;
} else if ($transaction == 'expire') {
  $sql = "UPDATE pembelian SET id_status_pembelian='5', token='$token' WHERE token='$order_id'";
  mysqli_query($conn, $sql);
  header("Location: list-pembelian");
  exit;
} else if ($transaction == 'cancel') {
  $sql = "UPDATE pembelian SET id_status_pembelian='6', token='$token' WHERE token='$order_id'";
  mysqli_query($conn, $sql);
  header("Location: list-pembelian");
  exit;
}
