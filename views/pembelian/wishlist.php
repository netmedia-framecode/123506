<?php require_once("../../controller/pembelian.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Wishlist";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Wishlist</li>
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
    <div class="row">
      <?php foreach($view_wishlist as $row => $data){?>
      <div class="col-lg-3">
        <form action="" method="post">
          <div class="card">
            <img src="../../assets/img/produk/<?= $data['image_produk']?>" class="card-img-top"
              style="height: 250px; object-fit: cover;" alt="<?= $data['nama_produk']?>">
            <div class="card-body">
              <h5 class="card-title"><?= $data['nama_produk']?></h5>
              <h4 class="card-text">Rp. <?= number_format($data['harga'])?></h4>
              <p class="card-text"><i class="bi bi-geo-fill"></i> Kota Kupang</p>
              <p class="card-text" style="margin-top: -10px;">Expired <?php $date = date_create($data["tgl_kadaluarsa"]);
                    echo date_format($date, "M Y"); ?></p>
              <p class="card-text" style="margin-top: -10px;">Stok Total: <?= $data['jumlah_produk']." | "?> <?php $id_produk = $data['id_produk'];
            $pembelian = "SELECT SUM(jumlah_produk) AS total_pembelian FROM pembelian WHERE id_produk='$id_produk'";
            $view_pembelian = mysqli_query($conn, $pembelian);
            $data_pembelian = mysqli_fetch_assoc($view_pembelian);
            if($data_pembelian['total_pembelian']==0){
              echo "0";
            }else{
              echo $data_pembelian['total_pembelian'];
            }
            ?> terjual</p>
              <label for="jumlah_keranjang" class="form-label">Jumlah pemesanan</label>
              <input type="number" name="jumlah_keranjang" class="form-control" id="jumlah_keranjang" value="1" min="1"
                max="<?= $data['jumlah_produk']?>" required>
            </div>
            <div class="card-footer d-flex">
              <input type="hidden" name="id_wishlist" value="<?= $data['id_wishlist']?>">
              <button type="submit" name="delete_wishlist" class="btn btn-danger"><i class="bi bi-trash"></i></button>
              <button type="submit" name="add_keranjang" class="btn btn-primary" style="margin-left: 5px;"><i class="bi bi-cart3"></i></button>
              <button type="submit" name="add_tagihan" class="btn btn-success" style="margin-left: 5px;"><i class="bi bi-bag me-2"></i>Beli</button>
            </div>
          </div>
        </form>
      </div>
      <?php }?>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>