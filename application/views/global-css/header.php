
<style>

  /*body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }*/

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Sistem Tempahan Bilik Mesyuarat</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport"
  />
  <link
    rel="icon"
    href="<?php echo base_url(); ?>/assets/img/kaiadmin/favicon.ico"
    type="image/x-icon"
  />

  <!-- Fonts and icons -->
  <script src="<?php echo base_url(); ?>/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["<?php echo base_url(); ?>/assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/demo.css" />
</head>

<div class="modal fade" id="reservationDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="icon-docs"></i>&nbsp;&nbsp;Butiran Tempahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- AJAX content will be loaded here -->
        <div class="text-center p-4" id="modal-loading" style="display:none;">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-2">Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="userDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="icon-docs"></i>&nbsp;&nbsp;Maklumat Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- AJAX content will be loaded here -->
        <div class="text-center p-4" id="modal-loading" style="display:none;">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-2">Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>
