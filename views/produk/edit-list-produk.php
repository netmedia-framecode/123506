<?php require_once("../../controller/produk.php");
if(!isset($_GET["p"])){
  header("Location: menu");
  exit();
}else{
  $id = valid($conn, $_GET["p"]); 
  $pull_data = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
    FROM produk
    JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
    JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk 
    WHERE produk.id_produk = '$id'
  ";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah List Produk";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">List Produk</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' '.$view_data["nama_produk"]  ?>
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
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_produk" value="<?= $view_data['id_produk'] ?>">
              <input type="hidden" name="imageOld" value="<?= $view_data['image_produk'] ?>">
              <input type="hidden" name="nama_produkOld" value="<?= $view_data['nama_produk'] ?>">
              <div class="mb-3">
                <label for="id_kategori_produk" class="form-label">Kategori Produk</label>
                <select name="id_kategori_produk" class="form-control" id="id_kategori_produk" required>
                  <option value="" selected>Pilih Kategori Produk</option>
                  <?php $id_kategori_produk = $view_data['id_kategori_produk'];
                    foreach ($view_kategori_produk as $data_kp) {
                      $selected = ($data_kp['id_kategori_produk'] == $id_kategori_produk) ? 'selected' : ''; ?>
                  <option value="<?= $data_kp['id_kategori_produk'] ?>" <?= $selected ?>><?= $data_kp['kategori_produk'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="id_status_produk" class="form-label">Status Produk</label>
                <select name="id_status_produk" class="form-control" id="id_status_produk" required>
                  <option value="" selected>Pilih Status Produk</option>
                  <?php $id_status_produk = $view_data['id_status_produk'];
                    foreach ($view_status_produk as $data_sp) {
                      $selected = ($data_sp['id_status_produk'] == $id_status_produk) ? 'selected' : ''; ?>
                  <option value="<?= $data_sp['id_status_produk'] ?>" <?= $selected ?>><?= $data_sp['status_produk'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Masukan gambar produk</label>
                <input class="form-control" name="image" type="file" id="image" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= $view_data['nama_produk']?>" class="form-control" id="nama_produk" placeholder="Nama Produk"
                  required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"><?= $view_data['deskripsi']?></textarea>
              </div>
              <div class="mb-3">
                <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                <input type="number" name="jumlah_produk" value="<?= $view_data['jumlah_produk']?>" class="form-control" id="jumlah_produk"
                  placeholder="Jumlah Produk" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" value="<?= $view_data['harga']?>" class="form-control" id="harga" placeholder="Harga" required>
              </div>
              <div class="mb-3">
                <label for="tgl_kadaluarsa" class="form-label">Tgl Kadaluarsa</label>
                <input type="date" name="tgl_kadaluarsa" value="<?= $view_data['tgl_kadaluarsa']?>" class="form-control" id="tgl_kadaluarsa"
                  placeholder="Tgl Kadaluarsa" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="list-produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="edit_produk" class="btn btn-warning">Ubah</button>
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