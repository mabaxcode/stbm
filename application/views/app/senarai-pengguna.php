<div class="page-inner">
  <div class="page-header">
    <h3 class="fw-bold mb-3"><?php echo $breadcrumb; ?></h3>
    <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="#">
          <i class="icon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">Pengguna</a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo $breadcrumb; ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <!-- datatable here -->
    <?php $this->load->view('app/component/datatable-senarai-pengguna'); ?>
  </div>
</div>
