    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Card Presensi -->
        <div class="mb-3">
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('pesan') ?>
                </div>
                
                <div class="col-12">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-start">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                        <?= date('l, d F Y') ?>
                                    </div>

                                    <div class="h3 my-3 font-weight-bold text-gray-800" id="realtime-clock">
                                        <?= date('h:i:s') ?>
                                    </div>
                                    
                                    <?php if ($cek_jadwal_hari_ini) { ?>
                                        <div class="d-flex flex-wrap align-items-start justify-content-between">
                                            <div class="mb-3">
                                                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">
                                                    Presensi Kehadiran: 
                                                    <span class="font-weight-normal">
                                                        <?= !is_null($presensi) ? $presensi['jam_masuk'] : 'Belum Presensi' ?>
                                                    </span>
                                                </div>
                                                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">
                                                    Lokasi Kehadiran: 
                                                    <span class="font-weight-normal">
                                                        <?= !is_null($presensi) && !is_null($presensi['lokasi_masuk']) ? json_decode($presensi['lokasi_masuk'])->location : '-' ?>
                                                    </span>
                                                </div>
                                                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800 d-flex align-items-center" style="gap: 10px;">
                                                    Status: 
                                                    <span class="font-weight-normal">
                                                        <?php
                                                            if (!is_null($presensi) && $presensi['status'] == 2) {
                                                                echo "<span class='badge badge-success'>Hadir</span>";
                                                            } elseif(!is_null($presensi) && $presensi['status'] == 3) {
                                                                echo "<span class='badge badge-warning'>Terlambat</span>";
                                                            } else {
                                                                echo "<span class='badge badge-danger'>Tidak Hadir</span>";
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                                
                                            <div class="mb-3">
                                                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">
                                                    Presensi Kepulangan: 
                                                    <span class="font-weight-normal">
                                                        <?= !is_null($presensi) && !is_null($presensi['jam_keluar']) ? $presensi['jam_keluar'] : 'Belum Presensi' ?>
                                                    </span>
                                                </div>
                                                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">
                                                    Lokasi Kepulangan: 
                                                    <span class="font-weight-normal">
                                                        <?= !is_null($presensi) && !is_null($presensi['lokasi_keluar']) ? json_decode($presensi['lokasi_keluar'])->location : '-' ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php if (is_null($presensi)) { ?> 

                                                <form action="<?= base_url('presensi/kehadiran/') . $user['nip'] ?>" method="post" class="mt-4">
                                                    <input type="hidden" id="lokasi_presensi" name="lokasi_masuk">
                                                    <button type="submit" class="btn btn-primary d-flex align-items-center" style="gap: 10px;">
                                                        <i class="fa fa-fingerprint"></i>
                                                        Presensi Kehadiran
                                                    </button>
                                                </form>

                                            <?php }
                                                if (!is_null($presensi) && is_null($presensi['jam_keluar'])) {
                                            ?>

                                                <form action="<?= base_url('presensi/kepulangan/') . $user['nip'] ?>" method="post" class="mt-4">
                                                    <input type="hidden" id="lokasi_presensi" name="lokasi_keluar">
                                                    <button type="submit" class="btn btn-primary d-flex align-items-center" style="gap: 10px;">
                                                        <i class="fa fa-fingerprint"></i>
                                                        Presensi Kepulangan
                                                    </button>
                                                </form>

                                            <?php } ?>
                                        </div>
                                    <?php } ?>

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

                <!-- <?php if ($cek_jadwal_hari_ini) { ?>
                
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

                <?php } ?> -->

                <div class="col-md-6">
                    
                </div>

            </div>
        </div>
        <!-- End Card Presensi -->

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
                                            <?= $total_hadir ?>
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
                                            <?= $total_terlambat ?>
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
                                            <?= $total_tidak_hadir ?>
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
                                        <th>Jam Masuk</th>
                                        <th>Lokasi Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Lokasi Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($presensi_hari_ini) > 0) {
                                        foreach ($presensi_hari_ini as $index => $absen) {      
                                    ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $absen['nip'] ?></td>
                                            <td><?= $absen['nama'] ?></td>
                                            <td><?= $absen['jam_masuk'] ?? '-' ?></td>
                                            <td><?= !is_null($absen['lokasi_masuk']) ? json_decode($absen['lokasi_masuk'])->location : '-' ?></td>
                                            <td><?= $absen['jam_keluar'] ?? '-' ?></td>
                                            <td><?= !is_null($absen['lokasi_keluar']) ? json_decode($absen['lokasi_keluar'])->location : '-' ?></td>
                                        </tr>
                                    <?php 
                                            }
                                        } else { 
                                    ?>
                                        <tr>
                                            <th colspan="6" class="text-center">Belum ada yang melakukan presensi hari ini</th>
                                        </tr>
                                    <?php } ?>
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

    function showPosition(position) {

        let lat = position.coords.latitude;
        let long = position.coords.longitude;

        const url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + lat + "&lon=" + long + "&zoom=18";
        let headers = new Headers();
        fetch(url, {
            headers: headers
        })
        .then(response => response.json())
        .then(data => {
            let road = (data.address.road === undefined) ? "" : data.address.road + `, `;
            let city = (data.address.city === undefined) ? "" : data.address.city + `, `;
            let county = (data.address.county === undefined) ? "" : data.address.county + `, `;
            let state = (data.address.state === undefined) ? "" : data.address.state + `, `;
            let postcode = (data.address.postcode === undefined) ? "" : data.address.postcode;
            const location = road + city + state + postcode;

            const locationValue = {
                lat,
                long,
                location
            }
            
            $('#lokasi_presensi').val(JSON.stringify(locationValue));

        }).catch(err => console.log('Error: ', err));
    }

    function error(err) {
        alert(`ERROR(${err.code}): ${err.message}`);
    }

    function getLocation(options) {
        if(!navigator.geolocation){
            alert("Can't Get your current location, because the browser didn't support this feature!");
        }else{
            navigator.geolocation.getCurrentPosition(showPosition, error, options);
        }
    }

    $(window).on('load', function() {
        const options = {
            enableHighAccuracy: true,
        };

        getLocation(options);
        startTime()
    })
</script>