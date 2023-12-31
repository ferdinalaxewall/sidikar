<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi untuk menampilkan Halaman Dashboard Beserta data yang dibutuhkan
    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->ModelUser->cariUser(['nip' => $this->session->userdata('nip')])->row_array();
        $data['jumlah_karyawan'] = $this->ModelUser->cariUser(['role' => 'pegawai'])->num_rows();
        $data['presensi_karyawan'] = $this->ModelPresensi->cariPresensiKaryawan('user_id', [
            'tanggal_presensi' => date('Y-m-d'),
        ])->result_array();

        // Mengambil data user_id yang sudah melakukan presensi
        $array_user_id_presensi = array_map( fn ($item) => $item['user_id'], $data['presensi_karyawan']);

        // Total Data Presensi
        $data['total_hadir'] = $this->ModelPresensi->cariPresensi([
            'status' => $this->ModelPresensi->HADIR,
            'tanggal_presensi' => date('Y-m-d')
        ])->num_rows();
        $data['total_terlambat'] = $this->ModelPresensi->cariPresensi([
            'status' => $this->ModelPresensi->TERLAMBAT,
            'tanggal_presensi' => date('Y-m-d')
        ])->num_rows();
        
        $data['total_tidak_hadir'] = $this->ModelPresensi->cariPresensi([
            'status' => $this->ModelPresensi->TIDAK_HADIR,
            'tanggal_presensi' => date('Y-m-d')
        ])->num_rows();

        $data['total_tidak_hadir'] += $this->ModelUser->cariUserWhereNotIn($array_user_id_presensi, [
            'role' => 'pegawai'
        ])->num_rows();

        // Data Presensi Hari Ini
        if ($data['user']['role'] == 'pegawai') {
            $data['presensi_hari_ini'] = $this->ModelPresensi->cariPresensiJoinKaryawan([
                'tanggal_presensi' => date('Y-m-d'),
                'user_id' => $data['user']['id']
            ], 10)->result_array();
        } else {
            $data['presensi_hari_ini'] = $this->ModelPresensi->cariPresensiJoinKaryawan([
                'tanggal_presensi' => date('Y-m-d')
            ], 10)->result_array();
        }

        // Mengecek Jadwal Hari ini
        $data['cek_jadwal_hari_ini'] = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l'),
            'is_active' => true
        ])->num_rows() > 0;

        if($data['cek_jadwal_hari_ini']) {
            $data['presensi'] = $this->ModelPresensi->cariPresensi([
                'user_id' => $data['user']['id'],
                'tanggal_presensi' => date('Y-m-d')
            ])->row_array();
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('admin/templates/footer');
    }
}