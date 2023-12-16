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
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Administrator</span>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBookModal">
                        <i class="fa fa-plus"></i>
                        Tambah Administrator
                    </a>
                </div>

                <table class="table mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIP</th>
                            <th>Nama Administrator</th>
                            <th>Jabatan</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($karyawan as $index => $pegawai) {
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $pegawai['nip'] ?></td>
                            <td><?= $pegawai['nama'] ?></td>
                            <td><?= $pegawai['nama_jabatan'] ?></td>
                            <td><?= $pegawai['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td><?= date('d-m-Y', strtotime($pegawai['tgl_lahir'])) ?></td>
                            <td>
                                <a href="<?= base_url('administrator/ubahAdministrator/') . $pegawai['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('administrator/hapusAdministrator/') . $pegawai['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin akan menghapus administrator <?= $pegawai['nama'] ?>?')">
                                    <i class="fa fa-trash"></i>
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


 <!-- Add Book Modal-->
 <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Administrator</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('administrator') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nip" class="form-label">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="nip" placeholder="Masukkan NIP Administrator" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Administrator</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Administrator" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_jabatan" class="form-label">Jabatan</label>
                        <select name="id_jabatan" id="id_jabatan" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Jabatan</option>
                            <?php foreach($jabatan as $jbt) { ?>
                                <option value="<?= $jbt['id'] ?>"><?= $jbt['nama_jabatan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-user" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Tambah
                    </button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>