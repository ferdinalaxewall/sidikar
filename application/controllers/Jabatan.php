<?php

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi untuk menampilkan Data Jabatan Karyawan
    public function index()
    {
        $data['judul'] = 'Data Jabatan Karyawan';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['list_jabatan'] = $this->ModelJabatan->cariSemuaJabatan();

        // Validasi tambah Data Jabatan
        $this->form_validation->set_rules(
            'nama_jabatan',
            'Nama Jabatan',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'min_jam_kerja',
            'Minimal Jam Kerja',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('jabatan/index', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Proses Menyimpan Data Jabatan Baru ke dalam database

            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan', true),
                'min_jam_kerja' => abs($this->input->post('min_jam_kerja', true)),
            ];

            $this->ModelJabatan->simpanJabatan($data);

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Jabatan Karyawan Berhasil Ditambahkan</div>"
            );

            redirect(base_url('jabatan'));
        }
    }

    // Fungsi untuk mengubah data jabatan
    public function ubahJabatan()
    {
        $data['judul'] = 'Ubah Jabatan Karyawan';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['jabatan'] = $this->ModelJabatan->cariJabatan([
            'id' => $this->uri->segment(3)
        ])->row_array();

        // Validasi Ubah Data Jabatan
        $this->form_validation->set_rules(
            'nama_jabatan',
            'Nama Jabatan',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'min_jam_kerja',
            'Minimal Jam Kerja',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('jabatan/ubah-jabatan', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Proses Mengubah Data Jabatan di Database

            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan', true),
                'min_jam_kerja' => abs($this->input->post('min_jam_kerja', true)),
            ];

            $this->ModelJabatan->updateJabatan($data, [
                'id' => $this->uri->segment(3)
            ]);

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Jabatan Karyawan Berhasil Diperbarui</div>"
            );

            redirect(base_url('jabatan'));
        }
    }

    // Fungsi untuk menghapus data jabatan
    public function hapusJabatan()
    {
        $this->ModelJabatan->hapusJabatan([
            'id' => $this->uri->segment(3)
        ]);

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-success alert-message' role='alert'>Jabatan Karyawan Berhasil Dihapus</div>"
        );
        
        redirect(base_url('jabatan'));
    }
}