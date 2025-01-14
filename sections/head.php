<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="<?= $data_utilities['keyword']?>">
<meta name="description" content="<?= $data_utilities['description']?>">
<meta name="author" content="<?= $data_utilities['author']?>">
<link rel="icon" href="<?= $baseURL?>assets/img/<?= $data_utilities['logo']?>" type="image/png">
<title><?= $data_utilities['name_web']?> <?php if (isset($_SESSION['project_cv_aquila_indonesia']['name_page'])) {
                          if (!empty($_SESSION['project_cv_aquila_indonesia']['name_page'])) {
                            echo " - " . $_SESSION['project_cv_aquila_indonesia']['name_page'];
                          }
                        } ?></title>
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/preloader.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/animate.min.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/magnific-popup.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/meanmenu.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/animate.min.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/slick.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/fontawesome-all.min.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/themify-icons.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/nice-select.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/ui-range-slider.css">
<link rel="stylesheet" href="<?= $baseURL?>assets/ui/css/main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<script src="<?= $baseURL ?>assets/sweetalert/dist/sweetalert2.all.min.js"></script>