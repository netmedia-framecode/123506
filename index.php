<?php require_once("controller/visitor.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "";
require_once("templates/top.php"); ?>

<main>

  <!-- slider area start -->
  <section class="slider-area-rel">
    <div class="slider-active dot-style dot-style-1 dot-bottom-center">
      <div class="single-slider single-slider-2 default-bg slider-height-2 d-flex align-items-center"
        data-background="assets/img/banner-1.jpg">
        <div class="container container-2">
          <div class="row align-items-center">
            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 pt-60 pb-10 pt-md-0 pb-md-0">
              <div class="slider-content-2">
                <span class="s-subtitle s-subtitle-3 pb-25" data-animation="fadeInUp" data-delay=".3s"> Minuman dan
                  Snack Khas NTT</span>
                <h2 class="s-title s-title-2 pb-28" data-animation="fadeInUp" data-delay=".5s">CV Aquila Indonesia</h2>
                <p class="s-desc pb-75" data-animation="fadeInUp" data-delay=".7s">bergerak di bidang produksi dan
                  distribusi minuman herbal instan. </p>
                <div class="p-btn p-btn-5" data-animation="fadeInUp" data-delay=".9s">
                  <a href="tentang">Tentang Kami</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- slider area end -->

  <div class="category-area fix mt-3-px pb-75"></div>

  <!-- top selling area start -->
  <div class="top-selling-area mt-3-py pb-75">
    <div class="container">
      <div class="row">
        <div class="col-xxl-12">
          <div class="section-title top-selling-title text-center pb-47">
            <h3 class="p-title pb-15 mb-0">Produk Paling Laris</h3>
          </div>
        </div>
      </div>
      <div class="row pb-20">
        <?php foreach($view_produk as $data){?>
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
          <div class="single-product mb-15 wow fadeInUp" data-wow-delay=".1s">
            <div class="product-thumb">
              <img src="assets/img/produk/<?= $data['image_produk']?>" style="height: 300px; object-fit: cover;"
                alt="#">
              <div class="cart-btn cart-btn-1 p-abs">
                <form action="" method="post">
                  <input type="hidden" name="id_produk" value="<?= $data['id_produk']?>">
                  <input type="hidden" name="harga" value="<?= $data['harga']?>">
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
                  <input type="hidden" name="id_produk" value="<?= $data['id_produk']?>">
                  <input type="hidden" name="harga" value="<?= $data['harga']?>">
                  <input type="hidden" name="jumlah_keranjang" value="1">
                  <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                  <button type="submit" name="add_wishlist" class="icon-box icon-box-1"><i class="fal fa-heart"></i><i
                      class="fal fa-heart"></i></button>
                  <?php }else{?>
                  <button type="button" onclick="window.location.href='auth/'" class="icon-box icon-box-1"><i
                      class="fal fa-heart"></i><i class="fal fa-heart"></i></button>
                  <?php }?>
                </form>
              </div>
            </div>
            <div class="product-content">
              <h4 class="pro-title pro-title-1"><?= $data['nama_produk']?></h4>
              <div class="pro-price">
                <span>Rp.<?= number_format($data['harga'])?></span>
              </div>
              <div class="rating">
                <?php 
                $ulasan = "SELECT rating FROM ulasan WHERE id_produk='$data[id_produk]'";
                $view_ulasan = mysqli_query($conn, $ulasan);
                if(mysqli_num_rows($view_ulasan)>0){
                  $data = mysqli_fetch_assoc($view_ulasan);
                  $rating = $data['rating'];
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
      <div class="row">
        <div class="col-xxl-12">
          <div class="btn-area text-center wow fadeInUp" data-wow-delay="1.2s">
            <div class="p-btn p-btn-1">
              <a href="produk">Lihat Semua Produk</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- top selling area end -->

  <!-- banner area start -->
  <div class="banner-area pb-95">
    <div class="pl-15 pr-15">
      <div class="row">
        <?php foreach($view_kategori_produk as $data){?>
        <div class="col-xxl-6 col-lg-6 col-md-6 ps-0">
          <div class="single-banner single-banner-2 p-rel fix mb-30 mb-md-0 wow">
            <div class="thumb">
              <img src="assets/ui/img/banner/banner-3.jpg" class=" wow fadeInRight h-100" data-wow-delay=".10s" alt="#">
            </div>
            <div class="banner-content banner-content-2 wow fadeInLeft" data-wow-delay=".10s">
              <h4><a href="produk?kp=<?= $data['id_kategori_produk'] ?>"><?= $data['kategori_produk']?></a></h4>
              <div class="p-btn p-btn-2">
                <a href="produk?kp=<?= $data['id_kategori_produk'] ?>">Lihat <?= $data['kategori_produk']?> </a>
              </div>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
  <!-- banner area end -->

</main>

<?php require_once("templates/bottom.php"); ?>