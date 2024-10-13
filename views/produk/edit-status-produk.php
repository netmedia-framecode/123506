<?php require_once("../../controller/produk.php");
if(!isset($_GET["p"])){
  header("Location: menu");
  exit();
}else{
  $id = valid($conn, $_GET["p"]); 
  $pull_data = "SELECT * FROM status_produk WHERE id_status_produk = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah Status Produk";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Status Produk</li>
        <li class="breadcrumb-item">
          <?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' '.$view_data["status_produk"]  ?>
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
              <input type="hidden" name="id_status_produk" value="<?= $view_data['id_status_produk'] ?>">
              <div class="mb-3">
                <label for="status_produk" class="form-label">Status Produk</label>
                <input type="text" name="status_produk" value="<?= $view_data['status_produk']?>" class="form-control"
                  id="status_produk" placeholder="Status Produk" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="status-produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="edit_status_produk" class="btn btn-warning">Ubah</button>
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