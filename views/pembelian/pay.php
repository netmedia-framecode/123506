<?php
namespace Midtrans;


require_once dirname(__FILE__) . '/../../assets/vendor/midtrans/midtrans-php/Midtrans.php';
require_once("../../controller/pembelian.php");
if(!isset($_SESSION['detail_pembelian'])){
  header("Location: tagihan");
  exit();
}else{
  $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Pembayaran";
  require_once("../../templates/views_top.php");

  Config::$serverKey = 'SB-Mid-server-IyDnIUPJsi6onjoa1gCVgYSJ';
  Config::$clientKey = 'SB-Mid-client-WQkDTLiXwuA-YILv';
  // Config::$isProduction = true;
  Config::$isSanitized = true;
  Config::$is3ds = true;
  // Config::$appendNotifUrl = "https://example.com";
  // Config::$overrideNotifUrl = "https://example.com";

  function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
      echo "<code>";
      echo "<h4>Please set your server key from sandbox</h4>";
      echo "In file: " . __FILE__;
      echo "<br>";
      echo "<br>";
      echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-IyDnIUPJsi6onjoa1gCVgYSJ\';');
      die();
    } 
  }

  printExampleWarningMessage();
  
  $id_pembelian = $_SESSION['detail_pembelian']['id_pembelian'];
  $pembelian = "SELECT pembelian.*, users.name, users.email, users.tlpn, users.alamat, produk.image_produk, produk.nama_produk, produk.harga, produk.deskripsi, status_pembelian.status_pembelian, kategori_produk.kategori_produk 
    FROM pembelian
    JOIN users ON pembelian.id_user = users.id_user
    JOIN produk ON pembelian.id_produk = produk.id_produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_pembelian ON pembelian.id_status_pembelian = status_pembelian.id_status_pembelian
    WHERE pembelian.id_pembelian = '$id_pembelian'
  ";
  $view_pembelian = mysqli_query($conn, $pembelian);
 ?>

<div class="nxl-content" style="height: 110vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Pembayaran</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
      </ul>
    </div>
    <?php if($id_role == 1 || $id_role == 3 ){?>
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex d-md-none">
          <a href="javascript:void(0)" class="page-header-right-close-toggle">
            <i class="feather-arrow-left me-2"></i>
            <span>Back</span>
          </a>
        </div>
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
          <a href="tagihan" class="btn btn-primary">
            <i class="bi bi-arrow-90deg-left me-2"></i>
            <span>Kembali</span>
          </a>
        </div>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
    <?php }?>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content">
    <form action="" method="post">
      <div class="row">
        <div class="col-lg-8">
          <div class="card mb-3">
            <b class="card-body">
              <h4>Alamat Pengiriman</h4>
              <h6><i class="bi bi-geo-alt-fill"></i> Rumah . <?= $name?></h6>
              <p><?= $alamat.', '.$tlpn?></p>
              <div class="col-md-3">
                <a class="btn btn-outline-primary btn-sm" href="../profil">Ubah Alamat</a>
              </div>
            </b>
          </div>
          <?php foreach($view_pembelian as $row => $data){

            $transaction_details = array(
              'order_id' => $data['token'],
              'gross_amount' => $data['harga'],
            );
            $item_details = array(
              array(
                'id' => $data['id_pembelian'],
                'price' => $data['harga'],
                'quantity' => $data['jumlah_produk'],
                'name' => $data['nama_produk']
              ),
            );
            $customer_details = array(
              'first_name'    => $data['name'],
              'email'         => $data['email'],
              'phone'         => $data['tlpn'],
              'billing_address'  => $data['alamat']
            );
            // $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');
            $transaction = array(
              // 'enabled_payments' => $enable_payments,
              'transaction_details' => $transaction_details,
              'customer_details' => $customer_details,
              'item_details' => $item_details,
            );

            $snapToken = Snap::getSnapToken($transaction);
          ?>
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="../../assets/img/produk/<?= $data['image_produk']?>"
                  style="width: 250px; height: 300px; object-fit: cover; border-radius: 10px;" class="img-fluid p-3"
                  alt="<?= $data['nama_produk']?>">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?= $data['nama_produk']?></h5>
                  <p class="card-text"><?= $data['deskripsi']?></p>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4>Ringkasan belanja</h4>
            </div>
            <div class="card-body">
              <h6>Jumlah Pemesanan : <?= $data['jumlah_produk']?></h6>
              <h6>Harga : Rp. <?= number_format($data['harga'])?></h6>
              <h6 class="card-title">Total : Rp. <span
                  id="total_pembelian"><?= number_format($data['jumlah_produk']*$data['harga'])?></span></h6>
              <button type="button" id="pay-button" class="btn btn-primary w-100 mt-4"><i
                  class="bi bi-bag me-2"></i>Bayar</button>
              <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="SB-Mid-client-WQkDTLiXwuA-YILv"></script>
              <script type="text/javascript">
              document.getElementById('pay-button').onclick = function() {
                snap.pay('<?php echo $snapToken ?>');
              };
              </script>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php }
require_once("../../templates/views_bottom.php") ?>