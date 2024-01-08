<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>

    <div class="row">
        <div class="card col-12 px-3 py-2 shadow">

            <div class="table-responsive mt-2">
                <div class="page-header mb-3 mt-2">
                    <span class="text-primary d-inline-flex align-items-center font-weight-bold" style="gap: 10px">
                        <i class="fas fa-fingerprint"></i> 
                        Data Presensi
                    </span>
                    <span class="text-muted"> - <?= $tanggal ?></span>
                    <a href="<?= base_url('user/data_user') ?>" class="text-danger ml-3">
                        <i class="fas fa-search float-right"></i>
                    </a>
                </div>

                <table class="table mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIP</th>
                            <th>Nama Karyawan</th>
                            <th>Jam Masuk</th>
                            <th>Lokasi Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Lokasi Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($presensi_karyawan) > 0) {
                            foreach ($presensi_karyawan as $index => $absen) {      
                        ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $absen['nip'] ?></td>
                                <td><?= $absen['nama'] ?></td>
                                <td><?= $absen['jam_masuk'] ?? '-' ?></td>
                                <td><?= !is_null($absen['lokasi_masuk']) ? json_decode($absen['lokasi_masuk'])->location : '-' ?></td>
                                <td><?= $absen['jam_keluar'] ?? '-' ?></td>
                                <td><?= !is_null($absen['lokasi_keluar']) ? json_decode($absen['lokasi_keluar'])->location : '-' ?></td>
                            </tr>
                        <?php 
                                }
                            } else { 
                        ?>
                            <tr>
                                <th colspan="6" class="text-center">Belum ada yang melakukan presensi hari ini</th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>