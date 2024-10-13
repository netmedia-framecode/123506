<?php require_once("controller/visitor.php");
if(!isset($_GET['p'])){
  header("Location: produk");
  exit();
}else{
  $id_produk = valid($conn, $_GET['p']);
  $produk_detail = "SELECT produk.*, kategori_produk.kategori_produk, status_produk.status_produk
      FROM produk
      JOIN kategori_produk ON produk.id_kategori_produk = kategori_produk.id_kategori_produk
      JOIN status_produk ON produk.id_status_produk = status_produk.id_status_produk
      WHERE produk.id_produk = '$id_produk'";
  $view_produk_detail = mysqli_query($conn, $produk_detail);
  if(mysqli_num_rows($view_produk_detail)>0){
    $data = mysqli_fetch_assoc($view_produk_detail);
  }else if(mysqli_num_rows($view_produk_detail)==0){
    header("Location: produk");
    exit();
  }

  $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Produk Detail";
  require_once("templates/top.php");
  ?>

<main>

  <!-- breadcrumb area start -->
  <div class="breadcrumb-area-2 box-plr-45 gray-bg-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xxl-12">
          <nav aria-label="breadcrumb" class="breadcrumb-list-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Beranda</a></li>
              <li class="breadcrumb-item"><a href="produk">Produk</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $data['nama_produk']?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb area end -->

  <!-- product details area start -->
  <section class="product__details-area pb-45 box-plr-45 gray-bg-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="product__details-nav-wrapper d-sm-flex align-items-center">
            <div class="product__details-thumb">
              <div cs="tab-content" id="productDetailsTabContent">
                <div class="tab-pane fade show active" id="pro-nav-1" role="tabpanel" aria-labelledby="pro-nav-1-tab">
                  <div class="product-nav-thumb-wrapper">
                    <a href="assets/img/produk/<?= $data['image_produk']?>" class="product-img-zoom popup-image">
                      <i class="fal fa-compress"></i>
                    </a>
                    <img src="assets/img/produk/<?= $data['image_produk']?>"
                      style="width: 600px; height: 600px; object-fit: cover;" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-lg-6">
          <div class="product__details-content pt-60">
            <h3 class="product__details-title"><?= $data['nama_produk']?></h3>
            <div class="product__details-price">
              <span class="price">Rp.<?= number_format($data['harga'])?></span>
            </div>
            <div class="product__details-rating d-flex align-items-center mb-15">
              <ul class="mr-10">
                <?php 
                $ulasan = "SELECT rating FROM ulasan WHERE id_produk='$data[id_produk]'";
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
              </ul>
            </div>
            <p class="product-des"><?= $data['deskripsi']?></p>
            <div class="product__details-action">
              <form action="#" method="post">
                <div class="product__details-quantity d-sm-flex align-items-center">
                  <div class="product-quantity mb-20 mr-15">
                    <div class="cart-plus-minus"><input type="text" name="jumlah_keranjang" value="1" min="1"
                        max="<?= $data['jumlah_produk']?>" required /></div>
                  </div>
                  <div class="product-add-cart mb-20">
                    <input type="hidden" name="id_produk" value="<?= $data['id_produk']?>">
                    <input type="hidden" name="harga" value="<?= $data['harga']?>">
                    <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                    <button type="submit" name="add_keranjang" class="s-btn s-btn-2 s-btn-big">add to cart</button>
                    <?php }else{?>
                    <button type="button" onclick="window.location.href='auth/'" class="s-btn s-btn-2 s-btn-big">add to
                      cart</button>
                    <?php }?>
                  </div>
                </div>
              </form>
            </div>
            <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
            <div class="product__details-compare">
              <ul>
                <li>
                  <form action="" method="post">
                    <input type="hidden" name="id_produk" value="<?= $data['id_produk']?>">
                    <input type="hidden" name="harga" value="<?= $data['harga']?>">
                    <input type="hidden" name="jumlah_keranjang" value="1">
                    <button type="submit" name="add_wishlist" class="btn btn-link" style="text-decoration: none;"><i
                        class="fal fa-heart me-2"></i>Add to Wishlist</button>
                  </form>
                </li>
              </ul>
            </div>
            <?php }?>
            <div class="product__details-meta mb-25">
              <ul>
                <li>
                  <div class="product-availibility">
                    <span>Availability</span>
                    <p>
                      <span>In Stock <?= $data['jumlah_produk']?> pcs</span>
                    </p>
                  </div>
                </li>
                <li>
                  <div class="product-sku">
                    <span>Categories:</span>
                    <p>Makanan</p>
                  </div>
                </li>
                <li>
                  <div class="product-sku">
                    <span>Tags:</span>
                    <p>Khas NTT, Makanan, Minuman, Herbal</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product details area end -->

  <!-- product info area start -->
  <section class="product__info-area pt-95">
    <div class="container">
      <div class="row">
        <div class="col-xxl-12">
          <div class="product__info-btn text-center" role="tablist">
            <ul class="nav nav-tabs d-sm-flex justify-content-center" id="productInfoTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" type="button" id="review-tab" data-bs-toggle="tab"
                  data-bs-target="#review" role="tab" aria-controls="review" aria-selected="true">Ulasan</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xxl-12">
          <div class="product__info-tab-content tab-content pb-75">
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
              <div class="product__details-review mt-50">
                <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="produc-review-wrapper">
                      <?php 
                        $pull_ulasan = "SELECT ulasan.*, users.name FROM ulasan JOIN users ON ulasan.id_user=users.id_user WHERE ulasan.id_produk='$data[id_produk]'";
                        $store_ulasan = mysqli_query($conn, $pull_ulasan);
                        foreach($store_ulasan as $data_ulas){
                      ?>
                      <div class="product-review-item">
                        <div class="product-review-top d-flex align-items-center justify-content-between">
                          <div class="product-review-name d-sm-flex align-items-center">
                            <h4 class="mr-10"><?= $data_ulas['name']?></h4>
                            <span class="date"><?php $updated_at = date_create($data["updated_at"]);
                            echo date_format($updated_at, "M d, Y"); ?></span>
                          </div>
                          <div class="product-review-rating">
                            <ul>
                              <?php $rating = $data_ulas['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                  if ($i <= $rating) {
                                      echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                                  } else {
                                      echo '<i class="bi bi-star" style="color: gold;"></i>';
                                  }
                                }
                              ?>
                            </ul>
                          </div>
                        </div>
                        <p><?= $data_ulas['ulasan']?></p>
                      </div>
                      <?php }?>
                    </div>
                  </div>
                  <?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                    <div class="product-review-form pl-60">
                      <form action="#" method="post">
                        <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">
                        <input type="hidden" name="nama_produk" value="<?= $data['nama_produk'] ?>">
                        <h3 class="product-review-title">ANDA SEDANG MENINJAU: <span>“<?= $data['nama_produk']?>”</span>
                        </h3>
                        <div class="product-review-form-rating mb-40">
                        </div>
                        <div class="product-review-form-wrapper">
                          <div class="row">
                            <div class="col-xxl-12">
                              <style>
                              .star-rating {
                                display: flex;
                                flex-direction: row-reverse;
                                justify-content: left;
                                gap: 10px;
                              }

                              .star-rating input[type="radio"] {
                                display: none;
                                /* Sembunyikan radio button */
                              }

                              .star-rating label {
                                font-size: 2rem;
                                /* Ukuran bintang */
                                color: lightgray;
                                /* Warna default bintang */
                                cursor: pointer;
                              }

                              .star-rating input[type="radio"]:checked~label {
                                color: gold;
                                /* Warna bintang yang dipilih */
                              }

                              .star-rating label:hover,
                              .star-rating label:hover~label {
                                color: gold;
                                /* Warna bintang saat hover */
                              }
                              </style>
                              <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <div class="star-rating">
                                  <input type="radio" id="rating5" name="rating" value="5">
                                  <label for="rating5"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" id="rating4" name="rating" value="4">
                                  <label for="rating4"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" id="rating3" name="rating" value="3">
                                  <label for="rating3"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" id="rating2" name="rating" value="2">
                                  <label for="rating2"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" id="rating1" name="rating" value="1">
                                  <label for="rating1"><i class="bi bi-star-fill"></i></label>
                                </div>
                              </div>
                            </div>
                            <div class="col-xxl-12">
                              <div class="mb-3">
                                <label for="ulasan" class="form-label">Ulasan</label>
                                <textarea name="ulasan" class="form-control" id="ulasan" rows="3" required></textarea>
                              </div>
                            </div>
                            <div class="col-xxl-12">
                              <div class="product-review-btn">
                                <button type="submit" name="add_ulasan" class="s-btn s-btn-2 s-btn-big-2">Kirim
                                  Ulasan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php }?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product info area end -->

</main>

<?php }
require_once("templates/bottom.php"); ?>