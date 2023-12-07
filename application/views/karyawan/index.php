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
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Karyawan</span>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBookModal">
                        <i class="fa fa-plus"></i>
                        Tambah Karyawan
                    </a>
                </div>

                <table class="table mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIP</th>
                            <th>Nama Karyawan</th>
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
                            <td><?= $pegawai['jabatan'] ?></td>
                            <td><?= $pegawai['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td><?= date('d-m-Y', strtotime($pegawai['tgl_lahir'])) ?></td>
                            <td>
                                <a href="<?= base_url('karyawan/ubahKaryawan/') . $pegawai['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('karyawan/hapusKaryawan/') . $pegawai['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin akan menghapus karyawan <?= $pegawai['nama'] ?>?')">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('karyawan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nip" class="form-label">Nomor Induk Pegawai (NIP)</label>
                        <input type="text" name="nip" id="nip" placeholder="Masukkan NIP Karyawan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama Karyawan</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Karyawan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" placeholder="Masukkan jabatan Karyawan" class="form-control" required>
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