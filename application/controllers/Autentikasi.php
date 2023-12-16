<?php

class Autentikasi extends CI_Controller
{
    // Fungsi untuk menampilkan Halaman Login
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url('dashboard'));
        }

        $this->form_validation->set_rules('nip', 'NIP',
            'required|numeric', [
            'required' => '%s Harus diisi!!',
            'numeric' => '%s Harus berisikan angka!!'
        ]);

        $this->form_validation->set_rules('password', 'Password',
            'required|trim', [
            'required' => '%s Harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';
            
            $this->load->view('templates/auth_header', $data);
            $this->load->view('autentikasi/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    // Fungsi untuk memproses autentikasi login
    private function _login()
    {
        $nip = $this->input->post('nip', true);
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cariUser([
            'nip' => $nip
        ]);

        if ($user->num_rows() > 0) {
            $user = $user->row_array();
            
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nip' => $user['nip'],
                    'role' => $user['role'],
                ];

                $this->session->set_userdata($data);

                redirect(base_url('dashboard'));
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'
                );
                
                redirect(base_url('autentikasi'));
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-message" role="alert">NIP tidak terdaftar!!</div>'
            );

            redirect(base_url('autentikasi'));
        }
    }

    // Fungsi untuk menampilkan halaman yang di blokir
    public function blok()
    {
        $this->load->view('autentikasi/blok');
    }
    
    // Fungsi untuk menampilkan halaman yang di gagal di akses
    public function gagal()
    {
        $this->load->view('autentikasi/gagal');
    }

    // Fungsi untuk memproses logout akun
    public function logout()
    {
        $data = array(
            'email' => '',
            'role' => '',
        );

        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        redirect(base_url('autentikasi'));
    }
}