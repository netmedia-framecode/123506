<?php require_once("../../controller/pembelian.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Tagihan";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 110vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Tagihan</li>
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
                    <th class="text-center">Status Bayar</th>
                    <th class="text-center">Order ID</th>
                    <?php if($id_role <= 2){?>
                    <th class="text-center">Pembeli</th>
                    <?php }?>
                    <th class="text-center">Produk</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Jumlah Beli</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Catatan</th>
                    <th class="text-center">Tgl Tagihan</th>
                    <?php if($id_role == 1 || $id_role == 3){?>
                    <th class="text-center">Aksi</th>
                    <?php }?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($view_tagihan as $key => $data) { ?>
                  <tr class="single-item">
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-center">
                      <?php 
                        $badgeClasses = [
                          1 => 'bg-success',
                          2 => 'bg-success',
                          3 => 'bg-warning',
                          4 => 'bg-danger',
                          5 => 'bg-danger',
                        ];
                        $badgeClass = $badgeClasses[$data['id_status_pembelian']] ?? 'bg-secondary';
                        echo '<span class="badge '.$badgeClass.'">'.$data['status_pembelian'].'</span>';
                      ?>
                    </td>
                    <td>#<?= $data['order_id'] ?></td>
                    <?php if($id_role <= 2){?>
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
                    <td><?= $data['jumlah_produk'] ?> pcs</td>
                    <td>Rp.<?= number_format($data['harga']) ?> / pcs</td>
                    <td>Rp.<?= number_format($data['total_harga']) ?></td>
                    <td>
                      <p class="text-truncate-4-line" style="width: 200px;"><?= $data['catatan'] ?></p>
                    </td>
                    <td class="text-center"><?php $tgl_tagihan = date_create($data["tanggal_tagihan"]);
                    echo date_format($tgl_tagihan, "d M Y"); ?></td>
                    <?php if($id_role == 1 || $id_role == 3){?>
                    <td>
                      <div class="hstack gap-2 justify-content-center">
                        <a href="edit-tagihan?p=<?= $data['id_pembelian']?>" class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="" method="post" class="d-flex">
                          <input type="hidden" name="id_pembelian" value="<?= $data['id_pembelian'] ?>">
                          <input type="hidden" name="nama_produk" value="<?= $data['nama_produk'] ?>">
                          <button type="submit" name="delete_tagihan" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                          </button>
                          <button type="submit" name="pay" class="btn btn-primary btn-sm" style="margin-left: 10px;"><i
                              class="bi bi-bag me-2"></i>Bayar</button>
                        </form>
                      </div>
                    </td>
                    <?php }?>
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