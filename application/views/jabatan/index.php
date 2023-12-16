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
                    <span class="text-primary mt-2"><i class="fas fa-tag"></i> Data Jabatan Karyawan</span>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBookModal">
                        <i class="fa fa-plus"></i>
                        Tambah Jabatan Karyawan
                    </a>
                </div>

                <table class="table mt-3 default-dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Jabatan Karyawan</th>
                            <th>Minimal Jam Kerja</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($list_jabatan as $index => $jbt) {
                        ?>

                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $jbt['nama_jabatan'] ?></td>
                            <td><?= $jbt['min_jam_kerja'] ?> Jam</td>
                            <td>
                                <a href="<?= base_url('jabatan/ubahJabatan/') . $jbt['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= base_url('jabatan/hapusJabatan/') . $jbt['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah kamu yakin akan menghapus jabatan <?= $jbt['nama_jabatan'] ?>?')">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('jabatan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" placeholder="Masukkan Nama Jabatan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="min_jam_kerja" class="form-label">Minimal Jam Kerja (Jam)</label>
                        <input type="number" name="min_jam_kerja" id="min_jam_kerja" placeholder="Masukkan NIP Jabatan Karyawan" min="0" class="form-control" required>
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