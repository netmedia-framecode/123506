<?php require_once("../../controller/laporan.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Export Produk";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Produk</li>
        <li class="breadcrumb-item">
          <?= $_SESSION["project_cv_aquila_indonesia"]["name_page"]  ?>
        </li>
      </ul>
    </div>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content" style="height: 100vh;">
    <div class="row">
      <div class="col-lg-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="bulan" class="form-label">Pilih Bulan</label>
                <select name="bulan" class="form-control" id="bulan">
                  <option value="" selected>Pilih Bulan</option>
                  <?php
                  $bulanArr = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                  ];
                  $selectedBulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';
                  foreach ($bulanArr as $key => $value) {
                    $selected = ($key == $selectedBulan) ? 'selected' : '';
                    echo "<option value='$key' $selected>$value</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="produk" class="btn btn-success">Kembali</a>
                <button type="submit" name="export_produk" class="btn btn-primary">Export</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

  </div>

  <?php require_once("../../templates/views_bottom.php") ?>