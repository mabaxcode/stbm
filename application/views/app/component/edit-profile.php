<?php /*<form action="<?php echo base_url('app/tempah'); ?>" method="post"> */?>
<!-- <form id="editUserForm"> -->
<form id="editUserFormData" method="post" action="<?= base_url('app/edit_profile_process') ?>">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Maklumat Profile</div>
            <!-- <p class="card-category"><i class="fas fa-info-circle"></i> Sila lengkapkan semua butiran untuk membuat tempahan</p> -->
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="form-group">
                    <label for="password">Nama</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="<?php echo set_value('name', $user['name']); ?>"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('name'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value="<?php echo set_value('email', $user['email']); ?>"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('email'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">No. Telefon</label>
                    <input
                        type="number"
                        class="form-control"
                        id="phone_no"
                        name="phone_no"
                        value="<?php echo set_value('phone_no', $user_info['phone_no']); ?>"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('phone_no'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">Jabatan</label>
                    <input
                        type="text"
                        class="form-control"
                        id="department_name"
                        name="department_name"
                        value="<?php echo set_value('department_name', $user_info['department_name']); ?>"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('department_name'); ?></div>
                </div>
                <div class="form-group">
                    <label for="comment">Jawatan</label>
                    <input
                        type="text"
                        class="form-control"
                        id="designation"
                        name="designation"
                        value="<?php echo set_value('designation', $user_info['designation']); ?>"
                    />
                    <div class="error" style="color: red;"><?php echo form_error('designation'); ?></div>
                </div>

                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['id']; ?>" />
            </div>
            </div>
        </div>
        <div class="card-action" align="right">
            <button class="btn btn-primary" type="submit" id="submitBtn" style="width: 150px;">Kemaskini</button>
            <a class="btn btn-danger" href="<?php echo base_url('app/profile') ?>">Batal</a>
        </div>
    </div>
</form>

