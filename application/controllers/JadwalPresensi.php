<?php

class JadwalPresensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi untuk menampilkan data jadwal presensi
    public function index()
    {
        $data['judul'] = 'Data Jadwal Presensi';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['jadwal_presensi'] = $this->ModelJadwalPresensi->cariSemuaJadwalPresensi();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('jadwal-presensi/index', $data);
        $this->load->view('admin/templates/footer');
    }

    // Fungsi untuk mengubah jadwal presensi
    public function ubahJadwal()
    {
        $data['judul'] = 'Ubah Jadwal Presensi';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['jadwal'] = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'id' => $this->uri->segment(3)
        ])->row_array();

        // Validasi ubah data jadwal presensi
        $this->form_validation->set_rules(
            'jam_masuk',
            'Jam Masuk',
            'required', [
                'required' => '%s Harus Diisi!'
        ]);

        $this->form_validation->set_rules(
            'jam_keluar',
            'Jam Masuk',
            'required', [
                'required' => '%s Harus Diisi!'
        ]);

        $this->form_validation->set_rules(
            'is_active',
            'Status Jadwal',
            'required|in_list[0,1]', [
                'required' => '%s Harus Diisi!',
                'in_list' => '%s Tidak Valid!',
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('jadwal-presensi/ubah-jadwal', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Proses Menyimpan data jadwal presensi terbaru ke database
            
            $data = [
                'jam_masuk' => $this->input->post('jam_masuk', true),
                'jam_keluar' => $this->input->post('jam_keluar', true),
                'is_active' => $this->input->post('is_active', true),
            ];

            // Update Jadwal Presensi Data
            $this->ModelJadwalPresensi->updateJadwalPresensi($data, [
                'id' => $this->uri->segment(3)
            ]);

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Jadwal Presensi Berhasil Diperbarui</div>"
            );

            redirect(base_url('jadwalPresensi'));
        }

    }
}