<?php require_once("../../controller/produk.php");
if(!isset($_GET["p"])){
  header("Location: menu");
  exit();
}else{
  $id = valid($conn, $_GET["p"]); 
  $pull_data = "SELECT * FROM kategori_produk WHERE id_kategori_produk = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah Kategori Produk";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Kategori Produk</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' '.$view_data["kategori_produk"]  ?>
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
          <fo class="card-body">
            <form action="" method="post">
              <input type="hidden" name="id_kategori_produk" value="<?= $view_data['id_kategori_produk'] ?>">
              <div class="mb-3">
                <label for="kategori_produk" class="form-label">Kategori Produk</label>
                <input type="text" name="kategori_produk" value="<?= $view_data['kategori_produk']?>" class="form-control"
                  id="kategori_produk" placeholder="Kategori Produk" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="kategori-produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="edit_kategori_produk" class="btn btn-warning">Ubah</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php }
        require_once("../../templates/views_bottom.php") ?>