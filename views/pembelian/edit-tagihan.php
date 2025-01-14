<?php require_once("../../controller/pembelian.php");
if(!isset($_GET["p"])){
  header("Location: menu");
  exit();
}else{
  $id = valid($conn, $_GET["p"]); 
  $pull_data = "SELECT pembelian.*, produk.nama_produk FROM pembelian JOIN produk ON pembelian.id_produk = produk.id_produk WHERE pembelian.id_pembelian = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah Tagihan";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Tagihan</li>
        <li class="breadcrumb-item">
          <?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' '.$view_data["nama_produk"]  ?>
        </li>
      </ul>
    </div>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content">
    <div class="row">
      <div class="col-lg-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <form action="" method="post">
              <input type="hidden" name="id_pembelian" value="<?= $view_data['id_pembelian'] ?>">
              <input type="hidden" name="nama_produk" value="<?= $view_data['nama_produk'] ?>">
              <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" id="catatan"
                  rows="3"><?= $view_data['catatan']?></textarea>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="tagihan" class="btn btn-success">Kembali</a>
                <button type="submit" name="edit_tagihan" class="btn btn-warning">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php }
        require_once("../../templates/views_bottom.php") ?>