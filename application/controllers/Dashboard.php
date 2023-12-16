<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->ModelUser->cariUser(['nip' => $this->session->userdata('nip')])->row_array();
        $data['jumlah_karyawan'] = $this->ModelUser->cariUser(['role' => 'pegawai'])->num_rows();

        $data['cek_jadwal_hari_ini'] = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l'),
            'is_active' => true
        ])->num_rows() > 0;

        if($data['cek_jadwal_hari_ini']) {
            $data['presensi'] = $this->ModelPresensi->cariPresensi([
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