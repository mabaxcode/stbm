
<div class="card card-profile">
    <div
    class="card-header"
    style="background-image: url('assets/img/blogpost.jpg')"
    >
    <div class="profile-picture">
        <div class="avatar avatar-xl">
        <img
            src="<?php echo base_url(); ?>assets/img/default-user.png"
            alt="..."
            class="avatar-img rounded-circle"
        />
        </div>
    </div>
    </div>
    <div class="card-body">
    <div class="user-profile text-center">
        <div class="name"><?php echo strtoupper($user['name']); ?></div>
        <div class="job"><?php echo ucfirst($user_info['designation']); ?></div>
        <div class="desc"><?php echo ucfirst($user_info['department_name']); ?></div>
        
        <div class="view-profile">
        <a 
        href="<?php echo base_url('app/edit_profile/'.$user['id']); ?>" 
        class="btn btn-secondary">
        <i class="fa fa-edit"></i>
        Kemaskini Profile
        </a>
        </div>
    </div>
    </div>
    <div class="card-footer">
    <div class="row user-stats text-center">
        <div class="col">
        <div class="number">Tarikh Pendaftaran</div>
        <div class="title"><?php echo convert_date($user['created_at']); ?></div>
        </div>
        <div class="col">
        <div class="number">Status</div>
        <div class="title">Aktif</div>
        </div>
        <div class="col">
        <div class="number">Peranan</div>
        <div class="title"><?php echo ucfirst($user['role']); ?></div>
        </div>
    </div>
    </div>
</div>

<div class="card card-round">
    <div class="card-body">
        <div class="card-title fw-mediumbold">Info</div>
            <div class="card-list">
                <div class="item-list">
                    <div class="info-user ms-0">
                        <div class="username">Nama Penuh</div>
                        <div class="status"><?php echo ucfirst($user['name']); ?></div>
                    </div>
                </div>
                <div class="item-list">
                    <div class="info-user ms-0">
                        <div class="username">No. Telefon</div>
                        <div class="status"><?php echo $user_info['phone_no']; ?></div>
                    </div>
                </div>
                <div class="item-list">
                    <div class="info-user ms-0">
                        <div class="username">Email</div>
                        <div class="status"><?php echo $user['email']; ?></div>
                    </div>
                </div>
                <div class="item-list">
                    <div class="info-user ms-0">
                        <div class="username">Nama Jawatan</div>
                        <div class="status"><?php echo ucfirst($user_info['designation']); ?></div>
                    </div>
                </div>
                <div class="item-list">
                    <div class="info-user ms-0">
                        <div class="username">Jabatan</div>
                        <div class="status"><?php echo ucfirst($user_info['department_name']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
