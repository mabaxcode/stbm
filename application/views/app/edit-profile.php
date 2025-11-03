<div class="page-inner">
  <div class="page-header">
    <h3 class="fw-bold mb-3">Kemaskini Profile</h3>
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
        <a href="#">Utama</a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">Kemaskini Profile</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
    <?php $this->load->view('app/component/edit-profile'); ?>
    </div>

  </div>
</div>