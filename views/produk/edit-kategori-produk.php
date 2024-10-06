<?php require_once("../../controller/produk.php");
        if(!isset($_GET["p"])){
          header("Location: menu");
          exit();
        }else{
          $id_menu = valid($conn, $_GET["p"]); 
          $menu = "SELECT * FROM user_menu WHERE id_menu = '$id_menu'";
          $edit_menu = mysqli_query($conn, $menu);
          $data_menu = mysqli_fetch_assoc($edit_menu);
        $_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Ubah Kategori Produk";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">Kategori Produk</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_cv_aquila_indonesia"]["name_page"].' '.$data_menu["menu"]  ?></li>
              </ul>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php }
        require_once("../../templates/views_bottom.php") ?>
        