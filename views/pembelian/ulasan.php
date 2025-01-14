<?php require_once("../../controller/pembelian.php");
if(!isset($_GET["p"])){
  header("Location: list-pembelian");
  exit();
}else{
  $id = valid($conn, $_GET["p"]); 
  $pull_data = "SELECT pembelian.*, produk.nama_produk FROM pembelian JOIN produk ON pembelian.id_produk = produk.id_produk WHERE pembelian.id_pembelian = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ulasan Produk";
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
              <input type="hidden" name="id_produk" value="<?= $view_data['id_produk'] ?>">
              <input type="hidden" name="nama_produk" value="<?= $view_data['nama_produk'] ?>">
              <style>
              .star-rating {
                display: flex;
                flex-direction: row-reverse;
                justify-content: left;
                gap: 10px;
              }

              .star-rating input[type="radio"] {
                display: none;
                /* Sembunyikan radio button */
              }

              .star-rating label {
                font-size: 2rem;
                /* Ukuran bintang */
                color: lightgray;
                /* Warna default bintang */
                cursor: pointer;
              }

              .star-rating input[type="radio"]:checked~label {
                color: gold;
                /* Warna bintang yang dipilih */
              }

              .star-rating label:hover,
              .star-rating label:hover~label {
                color: gold;
                /* Warna bintang saat hover */
              }
              </style>
              <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div class="star-rating">
                  <input type="radio" id="rating5" name="rating" value="5">
                  <label for="rating5"><i class="bi bi-star-fill"></i></label>

                  <input type="radio" id="rating4" name="rating" value="4">
                  <label for="rating4"><i class="bi bi-star-fill"></i></label>

                  <input type="radio" id="rating3" name="rating" value="3">
                  <label for="rating3"><i class="bi bi-star-fill"></i></label>

                  <input type="radio" id="rating2" name="rating" value="2">
                  <label for="rating2"><i class="bi bi-star-fill"></i></label>

                  <input type="radio" id="rating1" name="rating" value="1">
                  <label for="rating1"><i class="bi bi-star-fill"></i></label>
                </div>
              </div>
              <div class="mb-3">
                <label for="ulasan" class="form-label">Ulasan</label>
                <input type="text" name="ulasan" class="form-control" id="ulasan"
                  placeholder="Ulasan" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="list-pembelian" class="btn btn-success">Kembali</a>
                <button type="submit" name="add_ulasan" class="btn btn-success">Kirim Ulasan</button>
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