


<div class="card-round">
    <div class="card-body">
    <div class="card-list">
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">Nama</div>
                <div class="status"><b><?php echo $user['name']; ?></b></div>
            </div>
        </div>
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">Email</div>
                <div class="status"><b><?php echo $user['email']; ?></b></div>
            </div>
        </div>
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">Tarikh Pendaftaran</div>
                <div class="status"><b><?php echo dmy($user['created_at']); ?></b></div>
            </div>
        </div>
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">Jabatan</div>
                <div class="status"><b><?php echo strtoupper($user['department_name']); ?></b></div>
            </div>
        </div>
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">Jawatan</div>
                <div class="status"><b><?php echo strtoupper($user['designation']); ?></b></div>
            </div>
        </div>
        <div class="item-list">
            <div class="info-user ms-3">
                <div class="username">No. Telefon</div>
                <div class="status"><b><?php echo $user['strtoupper']; ?></b></div>
            </div>
        </div>
    </div>
    </div>
    </div>