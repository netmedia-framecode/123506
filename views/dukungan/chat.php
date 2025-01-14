<?php require_once("../../controller/dukungan.php");
$_SESSION["project_cv_aquila_indonesia"]["name_page"] = "Chat";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content without-header nxl-full-content">

  <!-- [ Main Content ] start -->
  <div class="main-content d-flex">

    <!-- [ Content Sidebar ] start -->
    <?php if($id_role <= 2 ){ ?>
    <div class="content-sidebar content-sidebar-xl" data-scrollbar-target="#psScrollbarInit">
      <div class="content-sidebar-header bg-white sticky-top hstack justify-content-between">
        <h4 class="fw-bolder mb-0">Chat</h4>
      </div>
      <div class="content-sidebar-body">
        <div class="content-sidebar-items">
          <?php foreach ($view_chat as $key => $data) {?>
          <a href="chat?u=<?= $data['id_user']?>">
            <div class="p-4 d-flex position-relative border-bottom c-pointer single-item">
              <div class="avatar-image">
                <img src="../../assets/img/profil/<?= $data['image']?>" class="img-fluid" alt="image">
              </div>
              <div class="ms-3 item-desc">
                <div class="w-100 d-flex align-items-center justify-content-between">
                  <div class="hstack gap-2 me-2">
                    <span><?= $data['name']?></span>
                    <div class="wd-5 ht-5 rounded-circle opacity-75 me-1 bg-success"></div>
                    <span class="fs-10 fw-medium text-muted text-uppercase d-none d-sm-block">
                      <?php $time = date_create($data["updated_at"]);
                              echo date_format($time, "d m Y - h:i a");?></span>
                  </div>
                </div>
                <p class="fs-12 fw-semibold text-dark mt-2 mb-0 text-truncate-2-line">
                  <?php if(!empty($data['reply'])){
                      echo $data['reply'];
                    }else{
                      echo $data['start'];
                    }
                  ?>
                </p>
              </div>
            </div>
          </a>
          <?php }?>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- [ Content Sidebar  ] end -->

    <!-- [ Main Area  ] start -->
    <?php if($id_role <= 2 ){ ?>
    <div class="content-area" data-scrollbar-target="#psScrollbarInit">
      <?php if(isset($_GET['u'])){
        $id = valid($conn, $_GET['u']);
        $pull_data = "SELECT chat.*, users.image, users.name FROM chat JOIN users ON chat.id_user = users.id_user WHERE chat.id_user = '$id'";
        $store_data = mysqli_query($conn, $pull_data);
        $view_data = mysqli_fetch_assoc($store_data);
        ?>
      <div class="content-area-header sticky-top">
        <div class="page-header-left hstack gap-4">
          <a href="javascript:void(0);" class="app-sidebar-open-trigger">
            <i class="feather-align-left fs-20"></i>
          </a>
          <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center gap-3"
            data-bs-toggle="offcanvas" data-bs-target="#userProfileDetails">
            <div class="avatar-image">
              <img src="../../assets/img/profil/<?= $view_data['image']?>" class="img-fluid" alt="image">
            </div>
            <div class="d-none d-sm-block">
              <div class="fw-bold d-flex align-items-center"><?= $view_data['name']?></div>
              <div class="d-flex align-items-center mt-1">
                <span class="wd-7 ht-7 rounded-circle opacity-75 me-2 bg-success"></span>
                <span class="fs-9 text-uppercase fw-bold text-success">Active Now</span>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="content-area-body">
        <?php foreach ($store_data as $key => $data) {?>
        <!--! BEGIN: Single Message [start] !-->
        <div class="single-chat-item">
          <div class="d-flex align-items-center gap-3">
            <a href="javascript:void(0)" class="avatar-image">
              <img src="../../assets/img/profil/<?= $data['image']?>" class="img-fluid rounded-circle" alt="image">
            </a>
            <div class="d-flex align-items-center gap-2">
              <a href="javascript:void(0);"><?= $data['name']?></a>
              <span class="wd-5 ht-5 bg-gray-400 rounded-circle"></span>
              <span class="fs-11 text-muted"><?php $time = date_create($data["created_at"]);
                          echo date_format($time, "d M Y - h:i a");?></span>
            </div>
          </div>
          <div class="wd-500 p-3 rounded-5">
            <p class="py-2 px-3 rounded-5 bg-white"><?= $data['start']?></p>
          </div>
        </div>
        <!--! END: Single Message  [start] !-->
        <!--! BEGIN: Single Message [Reply] !-->
        <?php if(!empty($data['reply'])){?>
        <div class="single-chat-item">
          <div class="d-flex flex-row-reverse align-items-center gap-3">
            <a href="javascript:void(0)" class="avatar-image">
              <img src="../../assets/img/<?= $data_utilities['logo']?>" class="img-fluid rounded-circle" alt="image">
            </a>
            <div class="d-flex flex-row-reverse align-items-center gap-2">
              <a href="javascript:void(0);"><?= $data_utilities['name_web']?></a>
              <span class="wd-5 ht-5 bg-gray-400 rounded-circle"></span>
              <span class="fs-11 text-muted"><?php $time = date_create($data["updated_at"]);
                          echo date_format($time, "d M Y - h:i a");?></span>
            </div>
          </div>
          <div class="wd-500 p-3 rounded-5 ms-auto">
            <p class="py-2 px-3 rounded-5 bg-white"><?= $data['reply']?></p>
          </div>
        </div>
        <?php }?>
        <!--! END: Single Message [Reply] !-->
        <?php }?>
      </div>
      <!--! BEGIN: Message Editor !-->
      <form action="" method="post">
        <input type="hidden" name="id_user" value="<?= $id ?>">
        <div class="d-flex align-items-center justify-content-between border-top border-gray-5 bg-white sticky-bottom">
          <input name="message" class="form-control border-0 emoji-picker" placeholder="Tulis pesan kamu disini...">
          <div class="border-start border-gray-5 send-message">
            <button type="submit" name="update_message"
              class="btn btn-success wd-60 d-flex align-items-center justify-content-center" data-bs-toggle="tooltip"
              data-bs-trigger="hover" title="Send Message" style="height: 59px"><i class="feather-send"></i></button>
          </div>
        </div>
      </form>
      <?php }?>
      <!--! END: Message Editor !-->
    </div>
    <?php }if($id_role == 3 ){ ?>
    <div class="content-area" data-scrollbar-target="#psScrollbarInit">
      <div class="content-area-header sticky-top">
        <div class="page-header-left hstack gap-4">
          <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center gap-3"
            data-bs-toggle="offcanvas" data-bs-target="#userProfileDetails">
            <div class="avatar-image">
              <img src="../../assets/img/<?= $data_utilities['logo']?>" class="img-fluid" alt="image">
            </div>
            <div class="d-none d-sm-block">
              <div class="fw-bold d-flex align-items-center"><?= $data_utilities['name_web']?></div>
              <div class="d-flex align-items-center mt-1">
                <span class="wd-7 ht-7 rounded-circle opacity-75 me-2 bg-success"></span>
                <span class="fs-9 text-uppercase fw-bold text-success">Active Now</span>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="content-area-body">
        <?php foreach ($view_chat as $key => $data) {?>
        <!--! BEGIN: Single Message [Reply] !-->
        <div class="single-chat-item">
          <div class="d-flex flex-row-reverse align-items-center gap-3">
            <a href="javascript:void(0)" class="avatar-image">
              <img src="../../assets/img/profil/<?= $data['image']?>" class="img-fluid rounded-circle" alt="image">
            </a>
            <div class="d-flex flex-row-reverse align-items-center gap-2">
              <a href="javascript:void(0);"><?= $data['name']?></a>
              <span class="wd-5 ht-5 bg-gray-400 rounded-circle"></span>
              <span class="fs-11 text-muted"><?php $time = date_create($data["created_at"]);
                          echo date_format($time, "d M Y - h:i a");?></span>
            </div>
          </div>
          <div class="wd-500 p-3 rounded-5 ms-auto">
            <p class="py-2 px-3 rounded-5 bg-white"><?= $data['start']?></p>
          </div>
        </div>
        <!--! END: Single Message [Reply] !-->
        <!--! BEGIN: Single Message [start] !-->
        <?php if(!empty($data['reply'])){?>
        <div class="single-chat-item">
          <div class="d-flex align-items-center gap-3">
            <a href="javascript:void(0)" class="avatar-image">
              <img src="../../assets/img/<?= $data_utilities['logo']?>" class="img-fluid rounded-circle" alt="image">
            </a>
            <div class="d-flex align-items-center gap-2">
              <a href="javascript:void(0);"><?= $data_utilities['name_web']?></a>
              <span class="wd-5 ht-5 bg-gray-400 rounded-circle"></span>
              <span class="fs-11 text-muted"><?php $time = date_create($data["updated_at"]);
                          echo date_format($time, "d M Y - h:i a");?></span>
            </div>
          </div>
          <div class="wd-500 p-3 rounded-5">
            <p class="py-2 px-3 rounded-5 bg-white"><?= $data['reply']?></p>
          </div>
        </div>
        <?php }?>
        <!--! END: Single Message  [start] !-->
        <?php }?>
      </div>
      <!--! BEGIN: Message Editor !-->
      <form action="" method="post">
        <div class="d-flex align-items-center justify-content-between border-top border-gray-5 bg-white sticky-bottom">
          <input name="message" class="form-control border-0 emoji-picker" placeholder="Tulis pesan kamu disini...">
          <div class="border-start border-gray-5 send-message">
            <button type="submit" name="send_message"
              class="btn btn-success wd-60 d-flex align-items-center justify-content-center" data-bs-toggle="tooltip"
              data-bs-trigger="hover" title="Send Message" style="height: 59px"><i class="feather-send"></i></button>
          </div>
        </div>
      </form>
      <!--! END: Message Editor !-->
    </div>
    <?php } ?>
    <!-- [ Content Area ] end -->

  </div>
  <!-- [ Content Area ] end -->

</div>
<!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>