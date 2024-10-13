<?php require_once("controller/visitor.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Tentang";
require_once("templates/top.php"); ?>

<main>

  <!-- page title start -->
  <section class="page__title-area pt-80 pb-65">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-10">
          <div class="page__title-wrapper text-center">
            <span class="page__title-pre">Hi, <?php if(!isset($_SESSION["project_cv_aquila_indonesia"]["users"])){echo "kamu disana!";}else{echo $name;}?></span>
            <h1 class="page__title">Tentang Kami</h1>
            <h3 class="page__title">CV Aquila Indonesia</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- page title end -->

  <!-- about banner area start -->
  <section class="about__banner">
    <div class="container-fluid p-0">
      <div class="row gx-0">
        <div class="col-xxl-12">
          <div class="about__banner-thumb w-img">
            <img src="assets/img/about.jpeg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about banner area end -->

  <!-- about history area start -->
  <section class="about__history pt-95 pb-75">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xxl-8 col-xl-10">
          <div class="about__history-wrapper">
            <div class="about__history-title-area">
              <span class="about__history-title-pre">Kisah Kami</span>
              <h3 class="about__history-title">
                <span>Halo, Kami Aquila Indonesia.</span> <br>
                Dengan Pengalaman Dari Tahun 2020
              </h3>
            </div>
            <p class="about__history-text">CV. Aquila Indonesia merupakan peningkatan status dari IMKM Aquila yang berdiri pada Tanggal 10 Oktober 2020 dan pada tahun 2022 berubah menjadi CV. Aquila Indonesia. Kami bergerak di bidang produksi dan distribusi minuman herbal instan, adapun produk-produk yang kami hasilkan saat ini adalah Jahe Merah Gula Aren, Jahe Merah Gula Kristal, Jahe Merah Tanpa Gula, Jahe Putih, Temulawak, Kunyit Putih, Beras Kencur, Kunyit Asam, Kopi Jahe Merah, Kopi Jahe Merah Gula Aren, Kunyit Kuning. </p>
            <p class="about__history-text">Pada bulan Desember 2022 kami mulai memproduksi beberapa macam snack seperti : Kacang Gula Jahe, Jagung bose Instan, Zara Cookies, Cookies Mete, Keripik Pisang, dan Keripik Tempe.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about history area end -->

</main>

<?php require_once("templates/bottom.php"); ?>