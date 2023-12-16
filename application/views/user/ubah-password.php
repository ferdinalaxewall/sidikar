<div class="container-fluid">
    <div class="row">

        <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        <?php } ?>

        <div class="col-lg-9">
            <?= $this->session->flashdata('pesan') ?>
        </div>

        <div class="col-lg-9">
            <form action="<?= base_url('user/ubahPassword') ?>" method="post">

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">
                        Password Lama
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="password_lama" id="password_lama" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">
                        Password Baru
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="password_baru" id="password_baru" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">
                        Konfirmasi Password Baru
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                        <a class="btn btn-dark" href="<?= base_url('user') ?>">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>