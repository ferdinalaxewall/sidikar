<div class="container-fluid">

    <h1 class="h3 mb-0 text-gray-800">Ubah Kategori Buku</h1>
    
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <form action="<?= base_url("jadwalPresensi/ubahJadwal/{$jadwal['id']}") ?>" method="post">
                    
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    <?php } ?>    

                    <div class="form-group">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" name="hari" id="hari" placeholder="Masukkan Hari" class="form-control" value="<?= $jadwal['hari'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" name="jam_masuk" id="jam_masuk" placeholder="Masukkan Jam Masuk" class="form-control" value="<?= $jadwal['jam_masuk'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                        <input type="time" name="jam_keluar" id="jam_keluar" placeholder="Masukkan Jam Keluar" class="form-control" value="<?= $jadwal['jam_keluar'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="form-label">Status Jadwal</label>
                        <div class="d-flex align-items-center flex-wrap" style="gap: 30px;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="exampleRadios1" value="1" <?= $jadwal['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="exampleRadios2" value="0" <?= !$jadwal['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="exampleRadios2">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>