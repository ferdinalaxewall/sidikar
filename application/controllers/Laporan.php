<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function presensi()
    {
        $data['judul'] = "Riwayat Presensi";
        $data['user'] = $this->ModelUser->cariUser(['nip' => $this->session->userdata('nip')])->row_array();
        $data['presensi_karyawan'] = $this->ModelPresensi->cariPresensiJoinKaryawan([
            'tanggal_presensi' => date('Y-m-d'),
        ])->result_array();

        $data['tanggal'] = date('d F Y');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('laporan/presensi', $data);
        $this->load->view('admin/templates/footer');
    }
}