<?php require_once("../controller/dashboard.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->

<div class="nxl-content">
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10">Dashboard</h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Dashboard</li>
      </ul>
    </div>
  </div>
  <div class="main-content">
    <div class="row">
      <?php if($id_role<=2){?>
      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full" style="cursor:pointer;"
          onclick="window.location.href='produk/list-produk'">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-gray-200">
                  <i class="bi bi-box-seam"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $count_produk?></span>
                  </div>
                  <h3 class="fs-13 fw-semibold text-truncate-1-line">Produk</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full" style="cursor:pointer;"
          onclick="window.location.href='pembelian/list-pembelian'">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-gray-200">
                  <i class="bi bi-bag-check"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $count_pembelian?></span>
                  </div>
                  <h3 class="fs-13 fw-semibold text-truncate-1-line">Pembelian</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full" style="cursor:pointer;"
          onclick="window.location.href='user-management/users'">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-gray-200">
                  <i class="bi bi-people"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $count_users?></span>
                  </div>
                  <h3 class="fs-13 fw-semibold text-truncate-1-line">users</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-gray-200">
                  <i class="bi bi-chat"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $count_chat?></span>/<span
                      class="counter"><?= $count_ulasan?></span>
                  </div>
                  <h3 class="fs-13 fw-semibold text-truncate-1-line"><span style="cursor:pointer;"
                      onclick="window.location.href='dukungan/chat'">Chat</span> / <span style="cursor:pointer;"
                      onclick="window.location.href='dukungan/ulasan'">Ulasan</span></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-8">
        <div class="card stretch stretch-full">
          <div class="card-header">
            <h5 class="card-title">Grafik Pembelian</h5>
            <div class="card-header-action">
              <div class="card-header-btn">
                <div data-bs-toggle="tooltip" title="Delete">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                </div>
                <div data-bs-toggle="tooltip" title="Refresh">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                </div>
                <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body custom-card-action p-0">
            <?php
            $chart = "SELECT MONTH(created_at) as bulan, SUM(jumlah_produk) as total_produk, SUM(total_harga) as total_pendapatan FROM pembelian GROUP BY MONTH(created_at)";
            $view_chart = mysqli_query($conn, $chart);
            $bulan = [];
            $total_produk = [];
            $total_pendapatan = [];
            while ($row = mysqli_fetch_assoc($view_chart)) {
              $bulan[] = $row['bulan'];
              $total_produk[] = $row['total_produk'];
              $total_pendapatan[] = $row['total_pendapatan'];
            }
            ?>
            <canvas id="pembelianChart"></canvas>
            <script>
            var bulan = <?php echo json_encode($bulan); ?>;
            var total_produk = <?php echo json_encode($total_produk); ?>;
            var total_pendapatan = <?php echo json_encode($total_pendapatan); ?>;
            var bulanLabels = bulan.map(function(item) {
              const bulanNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                "Dec"];
              return bulanNames[item - 1];
            });
            var ctx = document.getElementById('pembelianChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Produk',
                    data: total_produk,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                  },
                  {
                    label: 'Total Pendapatan',
                    data: total_pendapatan,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                  }
                ]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
            </script>
          </div>
          <div class="card-footer">
            <div class="row g-4">
              <div class="col-lg-3">
                <div class="p-3 border border-dashed rounded">
                  <div class="fs-12 text-muted mb-1">Pending</div>
                  <h6 class="fw-bold text-dark"><?= $count_pending?></h6>
                  <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="p-3 border border-dashed rounded">
                  <div class="fs-12 text-muted mb-1">Lunas</div>
                  <h6 class="fw-bold text-dark"><?= $count_lunas?></h6>
                  <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 32%"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="p-3 border border-dashed rounded">
                  <div class="fs-12 text-muted mb-1">Expire</div>
                  <h6 class="fw-bold text-dark"><?= $count_expire?></h6>
                  <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 18%"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="p-3 border border-dashed rounded">
                  <div class="fs-12 text-muted mb-1">Deny</div>
                  <h6 class="fw-bold text-dark"><?= $count_deny?></h6>
                  <div class="progress mt-2 ht-3">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: 5%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php }
      if($id_role==3){
        foreach($view_produk as $row => $data){?>
      <div class="col-lg-3">
        <form action="" method="post">
          <div class="card">
            <img src="../assets/img/produk/<?= $data['image_produk']?>" class="card-img-top"
              style="height: 250px; object-fit: cover;" alt="<?= $data['nama_produk']?>">
            <div class="card-body">
              <h5 class="card-title"><?= $data['nama_produk']?></h5>
              <h4 class="card-text">Rp. <?= number_format($data['harga'])?></h4>
              <p class="card-text"><i class="bi bi-geo-fill"></i> Kota Kupang</p>
              <p class="card-text" style="margin-top: -10px;">Expired <?php $date = date_create($data["tgl_kadaluarsa"]);
                    echo date_format($date, "M Y"); ?></p>
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
              <input type="number" name="jumlah_keranjang[]" class="form-control" id="jumlah_keranjang" value="1" min="1"
                max="<?= $data['jumlah_produk']?>" required>
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
      <div class="col-xxl-8">
        <div class="card stretch stretch-full">
          <div class="card-header">
            <h5 class="card-title">List Pembelian</h5>
            <div class="card-header-action">
              <div class="card-header-btn">
                <div data-bs-toggle="tooltip" title="Delete">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove"> </a>
                </div>
                <div data-bs-toggle="tooltip" title="Refresh">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh"> </a>
                </div>
                <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                  <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand"> </a>
                </div>
              </div>
              <div class="dropdown">
                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                  data-bs-offset="25, 25">
                  <div data-bs-toggle="tooltip" title="Options">
                    <i class="feather-more-vertical"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <?php if($id_role==1 || $id_role==3){?>
                  <a href="pembelian/keranjang" class="dropdown-item"><i class="bi bi-basket"></i>Keranjang</a>
                  <a href="pembelian/wishlist" class="dropdown-item"><i class="bi bi-heart"></i>Wishlist</a>
                  <?php }?>
                  <a href="pembelian/tagihan" class="dropdown-item"><i class="bi bi-receipt"></i>Tagihan</a>
                  <a href="pembelian/list-pembelian" class="dropdown-item"><i class="bi bi-bag-check"></i>List
                    Pembelian</a>
                  <div class="dropdown-divider"></div>
                  <a href="dukungan/chat" class="dropdown-item"><i class="bi bi-chat-dots"></i>Chat</a>
                  <a href="dukungan/ulasan" class="dropdown-item"><i class="bi bi-chat-right-quote"></i>Ulasan</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body custom-card-action p-0">
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
                    <th class="text-center">Tgl Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($view_list_pembelian as $key => $data) { ?>
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
                    <td class="text-center">#<?= $data['order_id'] ?></td>
                    <?php if($id_role <= 2){?>
                    <td class="project-name-td">
                      <div class="hstack gap-4">
                        <div class="avatar-image border-0">
                          <img src="../assets/img/profil/<?= $data['image']?>" alt="" class="img-fluid">
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
                          <img src="../assets/img/produk/<?= $data['image_produk']?>" alt="" class="img-fluid">
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
                    <td class="text-center">
                      <?php
                        if (!empty($data["tanggal_pembayaran"])) {
                          $tgl_pembayaran = date_create($data["tanggal_pembayaran"]);
                          echo date_format($tgl_pembayaran, "d M Y");
                        } else {
                          echo '-';
                        }
                       ?>
                    </td>
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
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>