<?php /*<form action="<?php echo base_url('app/tempah'); ?>" method="post"> */?>
<!-- <form id="editUserForm"> -->
<form id="editUserFormData" method="post" action="<?= base_url('app/do_change_password') ?>">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tukar Katalaluan</div>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-6 col-lg-12">

                <!-- success message -->
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="password">Katalaluan Sekarang</label>
                    <input
                        type="password"
                        class="form-control"
                        id="current_password"
                        name="current_password"
                    />
                    <!-- show password -->
                    <div class="error" style="color: red;"><?php echo form_error('current_password'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">Katalaluan Baru</label>
                    <input
                        type="password"
                        class="form-control"
                        id="new_password"
                        name="new_password"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('new_password'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">Sahkan Katalaluan</label>
                    <input
                        type="password"
                        class="form-control"
                        id="confirm_password"
                        name="confirm_password"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('confirm_password'); ?></div>
                </div>

            </div>
            </div>
        </div>
        <div class="card-action" align="right">
            <button class="btn btn-primary" type="submit" id="submitBtn" style="width: 200px;">Tukar Katalaluan</button>
            <a class="btn btn-danger" href="<?php echo base_url('app/profile') ?>">Batal</a>
        </div>
    </div>
</form>

