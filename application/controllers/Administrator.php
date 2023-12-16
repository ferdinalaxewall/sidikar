<?php

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi Untuk Menampilkan Data User dengan Role Administrator
    public function index()
    {
        $data['judul'] = 'Data Administrator';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['karyawan'] = $this->ModelUser->cariUser(['role' => 'admin'])->result_array();
        $data['jabatan'] = $this->ModelJabatan->cariSemuaJabatan();

        // Validasi Tambah Administrator
        $this->form_validation->set_rules(
            'nip',
            'NIP',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        $this->form_validation->set_rules(
            'nama',
            'Nama Administrator',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'id_jabatan',
            'Jabatan',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        $this->form_validation->set_rules(
            'jenis_kelamin',
            'Jenis Kelamin',
            'required|in_list[L,P]', [
                'required' => '%s harus diisi!',
                'in_list' => '%s tidak valid!',
        ]);

        $this->form_validation->set_rules(
            'tgl_lahir',
            'Tanggal Lahir',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('administrator/index', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Proses Menyimpan Data Administrator Baru ke database

            $nip = $this->input->post('nip', true);

            $data = [
                'nip' => $nip,
                'nama' => $this->input->post('nama', true),
                'id_jabatan' => $this->input->post('id_jabatan', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'password' => password_hash(
                    'sidikar-' . $nip,
                    PASSWORD_BCRYPT
                ),
                'role' => 'admin'
            ];

            $this->ModelUser->simpanUser($data);

            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Administrator Berhasil Ditambahkan</div>"
            );

            redirect(base_url('administrator'));
        }
    }

    // Fungsi untuk Mengubah Data Administrator
    public function ubahAdministrator() {
        $data['judul'] = 'Ubah Data Administrator';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['karyawan'] = $this->ModelUser->cariUser([
            'users.id' => $this->uri->segment(3)
        ])->row_array();
        $data['jabatan'] = $this->ModelJabatan->cariSemuaJabatan();
        
        // Validasi Ubah Data Administrator
        $this->form_validation->set_rules(
            'nip',
            'NIP',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        $this->form_validation->set_rules(
            'nama',
            'Nama Administrator',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'id_jabatan',
            'Jabatan',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'jenis_kelamin',
            'Jenis Kelamin',
            'required|in_list[L,P]', [
                'required' => '%s harus diisi!',
                'in_list' => '%s tidak valid!',
        ]);

        $this->form_validation->set_rules(
            'tgl_lahir',
            'Tanggal Lahir',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        if(! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('administrator/ubah-administrator', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Memperbarui Data Administrator pada Database

            $nip = $this->input->post('nip', true);

            $data = [
                'nip' => $nip,
                'nama' => $this->input->post('nama', true),
                'id_jabatan' => $this->input->post('id_jabatan', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'password' => password_hash(
                    'sidikar-' . $nip,
                    PASSWORD_BCRYPT
                ),
            ];

            $this->ModelUser->updateUser($data, [
                'id' => $this->uri->segment(3)
            ]);
            
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Administrator Berhasil Diperbarui</div>"
            );

            redirect(base_url('administrator'));
        }
    }

    // Fungsi untuk Menghapus Data Administrator di Database
    public function hapusAdministrator()
    {
        $this->ModelUser->hapusUser([
            'id' => $this->uri->segment(3)
        ]);

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-success alert-message' role='alert'>Administrator Berhasil Dihapus</div>"
        );
        
        redirect(base_url('administrator'));
    }
}
