<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi untuk menampilkan Profil Akun
    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('admin/templates/footer');
    }

    // Fungsi untuk mengubah data profil
    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        // Validasi Ubah Data Profil
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required|trim', [
                'required' => '%s Tidak Boleh Kosong'
        ]);

        $this->form_validation->set_rules(
            'jenis_kelamin',
            'Jenis Kelamin',
            'required|in_list[L,P]', [
                'required' => '%s Tidak Boleh Kosong',
                'in_list' => '%s Tidak Valid'
        ]);

        $this->form_validation->set_rules(
            'tgl_lahir',
            'Tanggal Lahir',
            'required', [
                'required' => '%s Tidak Boleh Kosong'
        ]);

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('user/ubah-profile', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $dto['nama'] = $this->input->post('nama', true);
            $dto['jenis_kelamin'] = $this->input->post('jenis_kelamin', true);
            $dto['tgl_lahir'] = $this->input->post('tgl_lahir', true);
            $upload_image = $_FILES['image']['name'];
            
            // Upload Image Jika Terdapat File yang di Upload
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['file_name'] = 'pro' . time();
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['user']['image'];

                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }

                    $dto['image'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-danger alert-message' role='alert'>{$this->upload->display_errors()}</div>"
                    );

                    redirect(base_url('user'));
                }
            }

            // Update User Data
            $this->db->where([
                'nip' => $this->session->userdata('nip')
            ]);
            $this->db->update('users', $dto);

            // Return The Notification Message
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-message" role="alert">Profil
                Berhasil diubah </div>'
            );

            redirect(base_url('user'));
        }
    }

    // Fungsi untuk mengubah password akun yang sedang login
    public function ubahPassword()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        // Validasi Ubah Password
        $this->form_validation->set_rules(
            'password_lama',
            'Password Lama',
            'required|min_length[8]', [
                'required' => '%s Tidak Boleh Kosong',
                'min_length' => '%s Minimal 8 Karakter'
        ]);

        $this->form_validation->set_rules(
            'password_baru',
            'Password Baru',
            'required|min_length[8]', [
                'required' => '%s Tidak Boleh Kosong',
                'min_length' => '%s Minimal 8 Karakter'
        ]);

        $this->form_validation->set_rules(
            'konfirmasi_password',
            'Konfirmasi Password Baru',
            'required|matches[password_baru]', [
                'required' => '%s Tidak Boleh Kosong',
                'matches' => '%s Tidak Valid'
        ]);

        if(! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('user/ubah-password', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // Cek Password Lama
            $cek_password_lama = password_verify($this->input->post('password_lama', true), $data['user']['password']);

            if ($cek_password_lama) {
                // Menyimpan Password Baru kedalam database
                $dataPassword = [
                    'password' => password_hash(
                        $this->input->post('password_baru', true),
                        PASSWORD_BCRYPT
                    ),
                ];

                $this->ModelUser->updateUser($dataPassword, [
                    'id' => $data['user']['id']
                ]);

                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-message" role="alert">Password Berhasil Diubah</div>'
                );
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">Password Lama Tidak Sesuai</div>'
                );
            }

            redirect(base_url('user/ubahPassword'));
        }
    }
}
