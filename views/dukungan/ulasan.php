<?php require_once("../../controller/dukungan.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ulasan";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Ulasan</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></li>
      </ul>
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
                    <th class="text-center">Rating</th>
                    <?php if($id_role<=2){?>
                    <th class="text-center">Pembeli</th>
                    <?php }?>
                    <th class="text-center">Produk</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Ulasan</th>
                    <th class="text-center">Tgl Diulas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($view_ulasan as $key => $data) { ?>
                  <tr class="single-item">
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-center">
                      <?php
                      $rating = $data['rating'];
                      for ($i = 1; $i <= 5; $i++) {
                          if ($i <= $rating) {
                              echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                          } else {
                              echo '<i class="bi bi-star" style="color: gold;"></i>';
                          }
                      }
                      ?>
                    </td>
                    <?php if($id_role<=2){?>
                    <td class="project-name-td">
                      <div class="hstack gap-4">
                        <div class="avatar-image border-0">
                          <img src="../../assets/img/profil/<?= $data['image']?>" alt="" class="img-fluid">
                        </div>
                        <div>
                          <p class="text-truncate-4-line" style="width: 200px;">
                            <?= $data['name']."<br>".$data['email']."<br>".$data['tlpn']."<br>".$data['alamat']?></p>
                        </div>
                      </div>
                    </td>
                    <?php }?>
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
                    <td>
                      <p class="text-truncate-4-line" style="width: 200px;"><?= $data['ulasan'] ?></p>
                    </td>
                    <td class="text-center"><?php $updated_at = date_create($data["updated_at"]);
                    echo date_format($updated_at, "d M Y"); ?></td>
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