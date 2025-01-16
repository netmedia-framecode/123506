<?php require_once("../../controller/pembelian.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Keranjang";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 110vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Keranjang</li>
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
          <a href="produk" class="btn btn-primary">
            <i class="feather-plus me-2"></i>
            <span>Tambah</span>
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
          <?php foreach($view_keranjang as $row => $data){?>
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 d-flex">
                <div class="form-check my-auto" style="margin-left: 20px;">
                  <input class="form-check-input shadow" name="id_keranjang[]" type="checkbox" style="font-size: 20px;"
                    value="<?= $data['id_keranjang']?>" data-idKeranjang="<?= $data['id_keranjang'] ?>" data-harga="<?= $data['harga'] ?>">
                </div>
                <img src="../../assets/img/produk/<?= $data['image_produk']?>"
                  style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;" class="img-fluid p-3"
                  alt="<?= $data['nama_produk']?>">
              </div>
              <div class="col-md-5">
                <div class="card-body">
                  <h5 class="card-title"><?= $data['nama_produk']?></h5>
                  <p class="card-text">
                    <?php 
                    $deskripsi = $data['deskripsi'];
                    $deskripsiArray = explode(' ', $deskripsi);
                    if (count($deskripsiArray) > 10) {
                      $deskripsi = implode(' ', array_slice($deskripsiArray, 0, 10)) . '...';
                    }
                    echo $deskripsi;
                    ?>
                  </p>
                  <p class="card-text"><i class="bi bi-geo-fill"></i> Kota Kupang</p>
                  <p class="card-text" style="margin-top: -10px;">Stok Total: <?= $data['jumlah_produk']." | "?>
                    <?php 
                    $id_produk = $data['id_produk'];
                    $pembelian = "SELECT SUM(jumlah_produk) AS total_pembelian FROM pembelian WHERE id_produk='$id_produk'";
                    $view_pembelian = mysqli_query($conn, $pembelian);
                    $data_pembelian = mysqli_fetch_assoc($view_pembelian);
                    echo $data_pembelian['total_pembelian'] ?? 0; ?> terjual
                  </p>
                </div>
              </div>
              <div class="col-md-3 my-auto">
                <h4 class="card-text mr-auto">Rp. <?= number_format($data['harga'])?></h4>
                <div class="d-flex">
                  <div class="mb-3">
                    <label for="jumlah_keranjang" class="form-label">Jumlah pemesanan</label>
                    <input type="number" name="jumlah_keranjang[]" class="form-control" id="jumlah_keranjang"
                      value="<?= $data['jumlah_keranjang']?>" min="1" max="<?= $data['jumlah_produk']?>"
                      style="width: 90px;" required>
                  </div>
                  <div class="mb-3">
                    <input type="hidden" name="id_cart" value="<?= $data['id_keranjang']?>">
                    <input type="hidden" name="nama_produk[]" value="<?= $data['nama_produk']?>">
                    <button type="submit" name="delete_keranjang" class="btn btn-danger"
                      style="margin-left: -10px; margin-top: 30px;"><i class="bi bi-trash"></i></button>
                  </div>
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
              <h6 class="card-title">Total</h6>
              <h4 class="card-text">Rp. <span id="total_pembelian">0</span></h4>
              <button type="submit" name="add_tagihan" class="btn btn-primary w-100 mt-4"><i
                  class="bi bi-bag me-2"></i>Beli</button>
            </div>
          </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const checkboxes = document.querySelectorAll('.form-check-input');
          const totalPembelian = document.getElementById('total_pembelian');
          function hitungTotal() {
            let total = 0;
            checkboxes.forEach(function(checkbox) {
              if (checkbox.checked) {
                const harga = parseInt(checkbox.getAttribute('data-harga'));
                const jumlahInput = checkbox.closest('.row').querySelector('input[name="jumlah_keranjang[]"]');
                const jumlah = parseInt(jumlahInput.value) || 1;
                total += harga * jumlah;
              }
            });
            totalPembelian.innerText = total.toLocaleString('id-ID');
          }
          checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', hitungTotal);
          });
          const jumlahInputs = document.querySelectorAll('input[name="jumlah_keranjang[]"]');
          jumlahInputs.forEach(function(input) {
            input.addEventListener('input', hitungTotal);
          });
        });
        </script>

      </div>
    </form>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>