<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>

    <div class="row">
        <div class="card col-12 px-3 py-2 shadow">

            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php } ?>

            <div class="table-responsive mt-2">
                <div class="page-header mb-3 d-flex align-items-center justify-content-between">
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Jadwal Presensi</span>
                </div>

                <table class="table mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($jadwal_presensi as $index => $jadwal) {
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $jadwal['hari'] ?></td>
                            <td><?= $jadwal['jam_masuk'] ?></td>
                            <td><?= $jadwal['jam_keluar'] ?></td>
                            <td>
                                <?php
                                    if ($jadwal['is_active']) {
                                        echo "<span class='badge badge-success'>Aktif</span>";
                                    } else {
                                        echo "<span class='badge badge-danger'>Tidak Aktif</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?= base_url('jadwalPresensi/ubahJadwal/') . $jadwal['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                                
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>