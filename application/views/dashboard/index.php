    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>



            <div class="mb-3">
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan') ?>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <?= date('l, d F Y') ?>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="realtime-clock">
                                            <?= date('h:i:s') ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('user/anggota') ?>">
                                            <i class="fa fa-clock fa-2x text-gray-300"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($cek_jadwal_hari_ini) { ?>
                    
                    <div class="col-md-6">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <?= !is_null($presensi) ? 'Presensi Kepulangan' : 'Presensi Kehadiran' ?>
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">
                                            <?php if (is_null($presensi)) { ?> 

                                                <form action="<?= base_url('presensi/kehadiran/') . $user['nip'] ?>">
                                                    <button type="submit" class="btn btn-info d-flex align-items-center" style="gap: 10px;">
                                                        <i class="fa fa-fingerprint"></i>
                                                        Lakukan Presensi Kehadiran Sekarang
                                                    </button>
                                                </form>

                                            <?php } else { ?>

                                                <form action="<?= base_url('presensi/kepulangan/') . $user['nip'] ?>">
                                                    <button type="submit" class="btn btn-info d-flex align-items-center" style="gap: 10px;">
                                                        <i class="fa fa-fingerprint"></i>
                                                        Lakukan Presensi Kepulangan Sekarang
                                                    </button>
                                                </form>

                                            <?php } ?>
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

                    <?php } ?>

                </div>
            </div>


        <?php if ($user['role'] == 'admin') { ?>

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

        <?php } ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    // Inside your Javascript file
    function startTime() {
        const today = new Date();
        const jam = today.getHours();
        const menit = checkTime(today.getMinutes());
        const detik = checkTime(today.getSeconds());
        
        $("#realtime-clock").html(`${jam}:${menit}:${detik}`)

        setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    $(window).on('load', function() {
        startTime()
    })
</script>