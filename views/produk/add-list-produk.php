<?php require_once("../../controller/produk.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Tambah List Produk";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">List Produk</li>
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
            <form action="" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="id_kategori_produk" class="form-label">Kategori Produk</label>
                <select name="id_kategori_produk" class="form-control" id="id_kategori_produk" required>
                  <option value="" selected>Pilih Kategori Produk</option>
                  <?php foreach ($view_kategori_produk as $data_kp) { ?>
                  <option value="<?= $data_kp['id_kategori_produk'] ?>"><?= $data_kp['kategori_produk'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="id_status_produk" class="form-label">Status Produk</label>
                <select name="id_status_produk" class="form-control" id="id_status_produk" required>
                  <option value="" selected>Pilih Status Produk</option>
                  <?php foreach ($view_status_produk as $data_sp) { ?>
                  <option value="<?= $data_sp['id_status_produk'] ?>"><?= $data_sp['status_produk'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Masukan gambar produk</label>
                <input class="form-control" name="image" type="file" id="image" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Nama Produk"
                  required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
                <input type="number" name="jumlah_produk" class="form-control" id="jumlah_produk"
                  placeholder="Jumlah Produk" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" placeholder="Harga" required>
              </div>
              <div class="mb-3">
                <label for="tgl_kadaluarsa" class="form-label">Tgl Kadaluarsa</label>
                <input type="date" name="tgl_kadaluarsa" class="form-control" id="tgl_kadaluarsa"
                  placeholder="Tgl Kadaluarsa" required>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="list-produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="add_produk" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

  </div>

  <?php require_once("../../templates/views_bottom.php") ?>