<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 justify-content-x">
            <?= $this->session->flashdata('pesan') ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px">
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="px-3 py-4">
                    <img src="<?= base_url("assets/img/profile/") . $user['image'] ?? 'default.png' ?>" class="card-img" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= "{$user['nama']} ({$user['jenis_kelamin']})" ?>
                    </h5>
                    <p class="card-text">
                        <?= $user['nip'] ?> - <?= $user['nama_jabatan'] ?? "Belum ada Jabatan" ?> 
                    </p>
                    <p class="card-text">
                        <small>Tanggal Lahir: </small>
                        <br>
                        <strong><?= date('d F Y', strtotime($user['tgl_lahir'])) ?></strong>
                    </p>
                </div>

                <div class="ml-3 my-3">
                    <a href="<?= base_url('user/ubahprofil'); ?>" class="btn btn-info">
                        <i class="fas fa-user-edit"></i> Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>