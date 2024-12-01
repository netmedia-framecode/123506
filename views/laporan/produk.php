<?php require_once("../../controller/laporan.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Produk";
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
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
      </ul>
    </div>
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex d-md-none">
          <a href="javascript:void(0)" class="page-header-right-close-toggle">
            <i class="feather-arrow-left me-2"></i>
            <span>Back</span>
          </a>
        </div>
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
          <a href="export-produk" class="btn btn-primary">
            <i class="bi bi-file-earmark-ruled me-2"></i>
            <span>Export</span>
          </a>
        </div>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card stretch stretch-full">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Produk</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width: 200px;">Deskripsi</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Tgl Kadaluarsa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($view_produk as $key => $data) { ?>
                  <tr class="single-item">
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="project-name-td">
                      <div class="hstack gap-4">
                        <div class="avatar-image border-0">
                          <img src="../../assets/img/produk/<?= $data['image_produk']?>" alt="" class="img-fluid">
                        </div>
                        <div>
                          <p class="text-truncate-3-line" style="width: 100px;"><?= $data['nama_produk']?></p>
                        </div>
                      </div>
                    </td>
                    <td><?= $data['kategori_produk'] ?></td>
                    <td><?= $data['status_produk'] ?></td>
                    <td>
                      <p class="text-truncate-3-line" style="width: 200px;"><?= $data['deskripsi']?></p>
                    </td>
                    <td><?= $data['jumlah_produk'] ?></td>
                    <td>Rp.<?= number_format($data['harga']) ?> / pcs</td>
                    <td>Rp.<?= number_format($data['harga']*$data['jumlah_produk']) ?></td>
                    <td><?php $tgl_kadaluarsa = date_create($data["tgl_kadaluarsa"]);
                    echo date_format($tgl_kadaluarsa, "d M Y"); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>