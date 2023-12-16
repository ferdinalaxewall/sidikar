<div class="container-fluid">

    <h1 class="h3 mb-0 text-gray-800">Ubah Jabatan Karyawan</h1>
    
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <form action="<?= base_url("jabatan/ubahJabatan/{$jabatan['id']}") ?>" method="post">

                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    <?php } ?>
                    
                    <div class="form-group">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" placeholder="Masukkan Nama Jabatan" value="<?= $jabatan['nama_jabatan'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="min_jam_kerja" class="form-label">Minimal Jam Kerja (Jam)</label>
                        <input type="number" name="min_jam_kerja" id="min_jam_kerja" placeholder="Masukkan NIP Jabatan Karyawan" min="0" value="<?= $jabatan['min_jam_kerja'] ?>" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>