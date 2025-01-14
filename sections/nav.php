<header>
  <div class="header-area">
    <div class="header-top pl-60 pr-60 d-none d-md-block">
      <div class="row align-items-center">
        <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-4">
          <p class="white-text center-text">Toko kami buka — selamat datang kembali.</p>
        </div>
        <div class="col-xxl-4 col-xl-7 col-lg-8 col-md-12 mx-auto">
          <div class="topbar-menu">
            <ul class="end-text">
              <?php if(!isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
              <li><a href="auth/">Login</a></li>
              <li><a href="auth/register">Register</a></li>
              <?php }else{?>
              <li><a href="auth/logout">Logout</a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="header-sticky"
      class="header-main header-main-2 header-padding-2 pl-60 pr-60 header-sticky header-sticky-white">
      <div class="row align-items-center">
        <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-4">
          <div class="header-left">
            <div class="logo pr-55 d-inline-block">
              <a href="./"><img src="<?= $baseURL?>assets/img/<?= $data_utilities['logo']?>" style="width: 50px;"
                  alt="#"></a>
            </div>
          </div>
        </div>
        <div class="col-xxl-6 col-xl-8 col-lg-8 d-none d-lg-block">
          <div class="main-menu p-rel d-flex align-items-center justify-content-center">
            <nav id="mobile-menu">
              <ul>
                <li><a href="./">Beranda</a></li>
                <li><a href="tentang">Tentang</a></li>
                <li><a href="produk">Produk</a></li>
                <li><a href="views/">Dashboard</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-8 col-sm-6 col-8">
          <div class="header-right-wrapper d-flex align-items-center justify-content-end">
            <div class="header-right header-right-2 d-flex align-items-center justify-content-end">
              <?php if(!isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
              <a href="auth/" class="d-none d-xxl-inline-block">Login / Register</a>
              <?php }else{?>
              <div class="header-icon header-icon-2 d-inline-block ml-30">
                <a href="views/dukungan/chat" class="search-toggle"><i class="bi bi-chat"></i></a>
                <a href="views/pembelian/wishlist" class="d-none d-xl-inline-block"><i
                    class="fal fa-heart"></i><span><?= $count_wishlist?></span></a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#cartMiniModal"><i
                    class="fal fa-shopping-cart"></i><span><?= $count_keranjang?></span></button>
              </div>
              <?php }?>
            </div>
            <div class="header-bar ml-20 d-lg-none">
              <button type="button" class="header-bar-btn header-bar-btn-black" data-bs-toggle="modal"
                data-bs-target="#offCanvasModal">
                <span></span>
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<?php if(isset($_SESSION["project_cv_aquila_indonesia"]["users"])){?>
<div class="cartmini__area">
  <div class="modal fade" id="cartMiniModal" tabindex="-1" aria-labelledby="cartMiniModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="cartmini__wrapper">
          <div class="cartmini__top d-flex align-items-center justify-content-between">
            <h4>Keranjang Kamu</h4>
            <div class="cartminit__close">
              <button type="button" data-bs-toggle="modal" data-bs-target="#cartMiniModal" class="cartmini__close-btn">
                <i class="fal fa-times"></i></button>
            </div>
          </div>
          <div class="cartmini__list">
            <ul>
              <?php foreach($view_keranjang as $data){ ?>
              <li class="cartmini__item p-rel d-flex align-items-start">
                <div class="cartmini__thumb mr-15">
                  <img src="<?= $baseURL?>assets/img/produk/<?= $data['image_produk'] ?>" alt="">
                </div>
                <div class="cartmini__content">
                  <h3 class="cartmini__title">
                    <?= $data['nama_produk']?>
                  </h3>
                  <span class="cartmini__price">
                    <span class="price">Rp.<?= number_format($data['harga'])?></span>
                  </span>
                  <p>Stok <?= number_format($data['jumlah_produk'])?> pcs</p>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="cartmini__bottom">
            <a href="views/pembelian/keranjang" class="s-btn w-100 mb-20">Lihat Keranjang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }?>