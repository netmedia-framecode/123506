<?php require_once("../../controller/produk.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "List Produk";
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
    <?php if($id_role <= 2){?>
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex d-md-none">
          <a href="javascript:void(0)" class="page-header-right-close-toggle">
            <i class="feather-arrow-left me-2"></i>
            <span>Back</span>
          </a>
        </div>
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
          <a href="add-list-produk" class="btn btn-primary">
            <i class="feather-plus me-2"></i>
            <span>Tambah</span>
          </a>
        </div>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
    <?php }?>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content">
    <div class="row">
      <?php if($id_role <= 2){?>
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
                    <th class="text-center">Aksi</th>
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
                    <td>
                      <div class="hstack gap-2 justify-content-center">
                        <a href="edit-list-produk?p=<?= $data['id_produk']?>" class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="" method="post">
                          <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">
                          <input type="hidden" name="nama_produk" value="<?= $data['nama_produk'] ?>">
                          <button type="submit" name="delete_produk" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php }else if($id_role == 3){
        foreach($view_produk as $row => $data){?>
      <div class="col-lg-3">
        <form action="" method="post">
          <div class="card">
            <img src="../../assets/img/produk/<?= $data['image_produk']?>" class="card-img-top"
              style="height: 250px; object-fit: cover;" alt="<?= $data['nama_produk']?>">
            <div class="card-body">
              <h5 class="card-title"><?= $data['nama_produk']?></h5>
              <h4 class="card-text">Rp. <?= number_format($data['harga'])?></h4>
              <p class="card-text"><i class="bi bi-geo-fill"></i> Kota Kupang</p>
              <p class="card-text" style="margin-top: -10px;">Stok Total: <?= $data['jumlah_produk']." | "?> <?php $id_produk = $data['id_produk'];
                $pembelian = "SELECT SUM(jumlah_produk) AS total_pembelian FROM pembelian WHERE id_produk='$id_produk'";
                $view_pembelian = mysqli_query($conn, $pembelian);
                $data_pembelian = mysqli_fetch_assoc($view_pembelian);
                if($data_pembelian['total_pembelian']==0){
                  echo "0";
                }else{
                  echo $data_pembelian['total_pembelian'];
                }
                ?> terjual</p>
              <label for="jumlah_keranjang" class="form-label">Jumlah pemesanan</label>
              <input type="number" name="jumlah_keranjang[]" class="form-control" id="jumlah_keranjang" value="1"
                min="1" max="<?= $data['jumlah_produk']?>" required>
            </div>
            <div class="card-footer d-flex">
              <input type="hidden" name="id_produk[]" value="<?= $data['id_produk']?>">
              <input type="hidden" name="harga[]" value="<?= $data['harga']?>">
              <input type="hidden" name="id_keranjang_all[]" value="0">
              <button type="submit" name="add_wishlist" class="btn btn-primary"><i class="bi bi-heart"></i></button>
              <button type="submit" name="add_keranjang" class="btn btn-primary" style="margin-left: 5px;"><i
                  class="bi bi-cart3"></i></button>
              <button type="submit" name="add_tagihan" class="btn btn-success" style="margin-left: 5px;"><i
                  class="bi bi-bag me-2"></i>Beli</button>
            </div>
          </div>
        </form>
      </div>
      <?php }}?>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>