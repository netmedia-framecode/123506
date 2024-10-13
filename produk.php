<?php require_once("controller/visitor.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Produk";
require_once("templates/top.php"); ?>

<main>

  <!-- breadcrumb area start -->
  <div class="breadcrumb-area pt-255 pb-265 mb-120" data-background="assets/img/produk.jpg">
    <div class="container">
      <div class="breadcrumb-title text-center">
        <h2>Produk</h2>
      </div>
      <div class="breadcrumb-list">
        <a href="./">Beranda</a>
        <a href="produk">Produk</a>
        <span>List Produk Lengkap</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb area end -->

  <!-- shop area start -->
  <div class="shop-area mb-70">
    <div class="container">
      <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-4">
          <div class="shop-sidebar-area pt-7 pr-60">
            <div class="single-widget pb-50 mb-50">
              <h4 class="widget-title">Kategori Produk</h4>
              <div class="widget-category-list">
                <form action="#">
                  <?php foreach($view_kategori_produk as $data){?>
                  <div class="single-widget-category">
                    <input type="checkbox" id="cat-item-1" name="cat-item">
                    <label onclick="window.location.href='produk?kp=<?= $data['id_kategori_produk']?>'"
                      for="cat-item-1"><?= $data['kategori_produk']?></label>
                  </div>
                  <?php }?>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-9 col-xl-9 col-lg-8 order-first order-lg-last">
          <div class="shop-top-area mb-40">
            <div class="row">
              <div class="col-xxl-4 col-xl-2 col-md-3 col-sm-3">
                <div class="shop-top-left">
                  <span class="label mr-15">View:</span>
                  <div class="nav d-inline-block tab-btn-group" id="nav-tab" role="tablist">
                    <button class="active" data-bs-toggle="tab" data-bs-target="#tab1" type="button"><i
                        class="fas fa-border-none"></i></button>
                    <button data-bs-toggle="tab" data-bs-target="#tab2" type="button"><i
                        class="fas fa-list"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /. shop top area -->
          <div class="shop-main-area">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade  show active" id="tab1">
                <div class="row pb-20">
                  <?php foreach($view_produk_1 as $data_1){?>
                  <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="single-product mb-15 wow fadeInUp" data-wow-delay=".1s">
                      <div class="product-thumb">
                        <img src="assets/img/produk/<?= $data_1['image_produk']?>"
                          style="height: 250px; object-fit: cover;" alt="#">
                        <div class="cart-btn cart-btn-1 p-abs">
                          <form action="" method="post">
                            <input type="hidden" name="id_produk" value="<?= $data_1['id_produk']?>">
                            <input type="hidden" name="harga" value="<?= $data_1['harga']?>">
                            <input type="hidden" name="jumlah_keranjang" value="1">
                            <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                            <button type="submit" name="add_keranjang"
                              style="width: 100%; color: #fff; padding: 10px; background-color: #228b22;"><i
                                class="bi bi-cart3"></i> Keranjang</button>
                            <?php }else{?>
                            <button type="button" onclick="window.location.href='auth/'"
                              style="width: 100%; color: #fff; padding: 10px; background-color: #228b22;"><i
                                class="bi bi-cart3"></i> Keranjang</button>
                            <?php }?>
                          </form>
                        </div>
                        <div class="product-action product-action-1 p-abs">
                          <form action="" method="post">
                            <input type="hidden" name="id_produk" value="<?= $data_1['id_produk']?>">
                            <input type="hidden" name="harga" value="<?= $data_1['harga']?>">
                            <input type="hidden" name="jumlah_keranjang" value="1">
                            <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                            <button type="submit" name="add_wishlist" class="icon-box icon-box-1"><i
                                class="fal fa-heart"></i><i class="fal fa-heart"></i></button>
                            <?php }else{?>
                            <button type="button" onclick="window.location.href='auth/'" class="icon-box icon-box-1"><i
                                class="fal fa-heart"></i><i class="fal fa-heart"></i></button>
                            <?php }?>
                          </form>
                        </div>
                      </div>
                      <div class="product-content">
                        <h4 class="pro-title pro-title-1"><a
                            href="produk-detail?p=<?= $data_1['id_produk']?>"><?= $data_1['nama_produk']?></a></h4>
                        <div class="pro-price">
                          <span>Rp.<?= number_format($data_1['harga'])?></span>
                        </div>
                        <div class="rating">
                          <?php 
                          $ulasan = "SELECT rating FROM ulasan WHERE id_produk='$data_1[id_produk]'";
                          $view_ulasan = mysqli_query($conn, $ulasan);
                          if(mysqli_num_rows($view_ulasan)>0){
                            $data_ulasan = mysqli_fetch_assoc($view_ulasan);
                            $rating = $data_ulasan['rating'];
                          }else{
                            $rating = 0;
                          }
                          for ($i = 1; $i <= 5; $i++) {
                              if ($i <= $rating) {
                                  echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                              } else {
                                  echo '<i class="bi bi-star" style="color: gold;"></i>';
                              }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
              <div class="tab-pane fade" id="tab2">
                <div class="product-wrap">
                  <?php foreach($view_produk_2 as $data_2){?>
                  <div class="single-product mb-30 puik-list-product-wrap">
                    <div class="row align-items-xl-center">
                      <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                        <div class="product-thumb mr-30 product-thumb-list">
                          <img src="assets/img/produk/<?= $data_2['image_produk']?>"
                            style="width: 250px; height: 250px; object-fit: cover;" alt="#">
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8">
                        <div class="puik-product-content puik-product-list-content">
                          <h4 class="pro-title pro-title-1"><a
                              href="produk-detail?p=<?= $data_2['id_produk']?>"><?= $data_2['nama_produk']?></a></h4>
                          <div class="pro-price">
                            <span>Rp.<?= number_format($data_2['harga'])?></span>
                          </div>
                          <div class="rating">
                            <?php 
                          $ulasan = "SELECT rating FROM ulasan WHERE id_produk='$data_2[id_produk]'";
                          $view_ulasan = mysqli_query($conn, $ulasan);
                          if(mysqli_num_rows($view_ulasan)>0){
                            $data_ulasan = mysqli_fetch_assoc($view_ulasan);
                            $rating = $data_ulasan['rating'];
                          }else{
                            $rating = 0;
                          }
                          for ($i = 1; $i <= 5; $i++) {
                              if ($i <= $rating) {
                                  echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                              } else {
                                  echo '<i class="bi bi-star" style="color: gold;"></i>';
                              }
                          }
                          ?>
                          </div>
                          <p><?= $data_2['deskripsi']?></p>
                          <div class="puik-shop-product-actions">
                            <form action="" method="post">
                              <input type="hidden" name="id_produk" value="<?= $data_2['id_produk']?>">
                              <input type="hidden" name="harga" value="<?= $data_2['harga']?>">
                              <input type="hidden" name="jumlah_keranjang" value="1">
                              <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                              <button type="submit" name="add_keranjang" class="puik-cart-btn"><i
                                  class="bi bi-cart3"></i> Keranjang</button>
                              <button type="submit" name="add_wishlist" class="puik-proudct-btn-boxed"><i
                                  class="fal fa-heart"></i></button>
                              <?php }else{?>
                              <button type="button" onclick="window.location.href='auth/'" class="puik-cart-btn"><i
                                  class="bi bi-cart3"></i> Keranjang</button>
                              <button type="button" onclick="window.location.href='auth/'" class="puik-proudct-btn-boxed"><i
                                  class="fal fa-heart"></i></button>
                              <?php }?>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
            </div>
          </div>
          <!-- /. shop main area -->
        </div>
      </div>
    </div>
  </div>
  <!-- shop area end -->

</main>

<?php require_once("templates/bottom.php"); ?>