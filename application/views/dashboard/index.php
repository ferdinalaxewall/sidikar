    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Presensi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">
                                        <form action="">
                                            <button type="submit" class="btn btn-info">
                                                Lakukan Presensi Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('user/anggota') ?>">
                                        <i class="fa fa-fingerprint fa-2x text-gray-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- Content Row -->
            <div class="row">
    
                <!-- Jumlah Karyawan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Karyawan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= $jumlah_karyawan ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('user/anggota') ?>">
                                        <i class="fa fa-users fa-2x text-gray-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Karyawan Hadir Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Karyawan Hadir
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('buku') ?>">
                                        <i class="fas fa-book fa-2x text-gray-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Karyawan Terlambat Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Karyawan Terlambat
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('user') ?>">
                                        <i class="fas fa-user-tag fa-2x text-gray-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Karyawan Tidak Hadir Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Karyawan Tidak Hadir
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        10
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('user') ?>">
                                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Content Row -->
    
            <div class="row px-2" style="row-gap: 15px;">
                <!-- Data Presensi Hari Ini -->
                <div class="card col-12 px-3 py-2 shadow">
                    <div class="table-responsive mt-2">
                        <div class="page-header mb-3 mt-2">
                            <span class="text-primary d-inline-flex align-items-center font-weight-bold" style="gap: 10px">
                                <i class="fas fa-fingerprint"></i> 
                                Data Presensi Hari Ini
                            </span>
                            <span class="text-muted"> - <?= date('d F Y') ?></span>
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
                                    <th>Jabatan</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="6" class="text-center">Belum ada yang melakukan presensi hari ini</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->