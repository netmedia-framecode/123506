<footer class="footer-area footer-1 black-bg pt-100  gray-bg-2 pb-80">
  <div class="copyright-area">
    <div class="copyright-text copyright-text-3 text-center pt-20">
      <div class="container">
        <p>Opening Time: Mon-Fri: <span>9:00 am – 9:00 pm.</span> <span>Sat: 9:00 am – 6:00 pm.</span> Sun:
          9:00 am – 6:00 pm.<br>
          Copyright &copy; <a href="https://wasd.netmedia-framecode.com" class="text-decoration-none">WASD Netmedia
        Framecode</a> <?= date('Y') ?> | Develop by Wenceslaus Hasan</p>
        <img src="assets/ui/img/icon/payments.png" alt="img">
      </div>
    </div>
  </div>
  <!-- /.copyright area end -->
</footer>

<script src="<?= $baseURL?>assets/ui/js/jquery.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/waypoints.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/bootstrap.bundle.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/tweenmax.js"></script>
<script src="<?= $baseURL?>assets/ui/js/owl.carousel.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/slick.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/jquery-ui-slider-range.js"></script>
<script src="<?= $baseURL?>assets/ui/js/jquery.meanmenu.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/isotope.pkgd.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/wow.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/jquery.scrollUp.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/countdown.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/jquery.magnific-popup.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/parallex.js"></script>
<script src="<?= $baseURL?>assets/ui/js/imagesloaded.pkgd.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/jquery.nice-select.min.js"></script>
<script src="<?= $baseURL?>assets/ui/js/main.js"></script>

<script>
const showMessage = (type, title, message) => {
  if (message) {
    Swal.fire({
      icon: type,
      title: title,
      text: message,
    });
  }
};

showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
showMessage("info", "For your information", $(".message-info").data("message-info"));
showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>