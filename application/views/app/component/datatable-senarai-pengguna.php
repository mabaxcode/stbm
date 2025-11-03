<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Senarai Pengguna</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table
            id="myReservationsTable"
            class="display table table-striped table-hover table-head-bg-secondary mt-4"
            style="background-color:#d9dce7;"
            >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Jawatan</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $key => $value): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo strtoupper($value['department_name']); ?></td>
                    <td><?php echo strtoupper($value['designation']); ?></td>
                    <td style="text-align: center;">
                        <?php 
                        // $encrypted_id = $this->encryption->encrypt($value['row_id']);
                        // $safe_id = urlencode(base64_encode($encrypted_id));
                        ?>
                        <a class="btn btn-sm btn-primary btn-view-user" data-init="<?php echo $value['row_id']; ?>" href="javascript:void(0);">Lihat Butiran</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<!-- btn-view-reservation is at global js -->

    