<div class="container-fluid">

    <h1 class="h3 mb-0 text-gray-800">Ubah Administrator</h1>
    
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <form action="<?= base_url("administrator/ubahAdministrator/{$karyawan['id']}") ?>" method="post">

                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    <?php } ?>
                    
                    <div class="form-group">
                        <label for="nip" class="form-label">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="nip" placeholder="Masukkan NIP Administrator" class="form-control" value="<?= $karyawan['nip'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Administrator</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Administrator" class="form-control" value="<?= $karyawan['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_jabatan" class="form-label">Jabatan</label>
                        <select name="id_jabatan" id="id_jabatan" class="form-control form-control-user" required>
                            <?php foreach($jabatan as $jbt) { ?>
                                <option value="<?= $jbt['id'] ?>"><?= $jbt['nama_jabatan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="L" <?= $karyawan['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $karyawan['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" class="form-control" value="<?= $karyawan['tgl_lahir'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>