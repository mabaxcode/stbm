<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header d-flex align-items-center" data-background-color="dark">
      <a href="<?php echo base_url('app');?>" class="logo">
        <img
          src="<?php echo base_url(); ?>/assets/img/kaiadmin/favicon.png"
          alt="navbar brand"
          class="navbar-brand"
          height="40"
        />
      </a>
      <span class="ms-2 text-white fw-bold">STBM</span>
      <button class="topbar-toggler more ms-auto">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>

    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item <?php echo ($this->uri->segment(1) == 'app' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
          <a
            href="<?php echo base_url('app');?>"
          >
            <i class="fas fa-home"></i>
            <p>Utama</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Menu</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#base">
            <i class="fas fa-table"></i>
            <?php if($this->session->userdata('user_role') == "admin"): ?>
              <p>Permohonan</p>
            <?php else: ?>
              <p>Tempahan</p>
            <?php endif; ?>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="base">
            <ul class="nav nav-collapse">
              <?php if($this->session->userdata('user_role') == "user"): ?>
              <li class="<?php echo ($this->uri->segment(2) == 'tempahan') ? 'active' : '' ?>">
                <a href="<?php echo base_url('app/tempahan');?>">
                  <span class="sub-item">Buat Tempahan</span>
                </a>
              </li>
              <li class="<?php echo ($this->uri->segment(2) == 'mybooking') ? 'active' : '' ?>">
                <a href="<?php echo base_url('app/mybooking');?>">
                  <span class="sub-item">Tempahan Saya</span>
                </a>
              </li>
              <?php endif; ?>

              <!-- admin menu -->
              <?php if($this->session->userdata('user_role') == "admin"): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'permohonan') ? 'active' : '' ?>">
                  <a href="<?php echo base_url('app/permohonan');?>">
                    <span class="sub-item">Proses Permohonan</span>
                  </a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'permohonan_lulus') ? 'active' : '' ?>">
                  <a href="<?php echo base_url('app/permohonan_lulus');?>">
                    <span class="sub-item">Permohonan Lulus</span>
                  </a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'permohonan_batal') ? 'active' : '' ?>">
                  <a href="<?php echo base_url('app/permohonan_batal');?>">
                    <span class="sub-item">Permohonan Batal</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </li>



        <?php if($this->session->userdata('user_role') == "admin"): ?>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#base">
            <i class="fas fa-table"></i>
              <p>Pengguna</p>
            <span class="caret"></span>
          </a>
          <div class="collapse show" id="base">
            <ul class="nav nav-collapse">
              
              <li class="<?php echo ($this->uri->segment(2) == 'senarai_pengguna') ? 'active' : '' ?>">
                <a href="<?php echo base_url('app/senarai_pengguna');?>">
                  <span class="sub-item">Senarai Pengguna</span>
                </a>
              </li>
              

              
            </ul>
          </div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>