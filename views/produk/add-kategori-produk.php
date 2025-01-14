<?php require_once("../../controller/produk.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Tambah Kategori Produk";
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
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
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
              <div class="mb-3">
                <label for="kategori_produk" class="form-label">Kategori Produk</label>
                <input type="text" name="kategori_produk" class="form-control" id="kategori_produk" placeholder="Kategori Produk" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="kategori-produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="add_kategori_produk" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>