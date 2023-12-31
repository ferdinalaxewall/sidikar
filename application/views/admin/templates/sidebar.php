<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SiDiKar</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('dashboard') ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<?php if ($user['role'] == 'admin') { ?> 

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Pengguna
</div>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('administrator') ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>Administrator</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('karyawan') ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>Karyawan</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master Data
</div>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('jabatan') ?>">
        <i class="fas fa-fw fa-tag"></i>
        <span>Jabatan</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('jadwalPresensi') ?>">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Jadwal Presensi</span></a>
</li>

<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Laporan
</div>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('laporan/presensi') ?>">
        <i class="fas fa-fw fa-table"></i>
        <span>Rekap Presensi</span></a>
</li>

</ul>
<!-- End of Sidebar -->