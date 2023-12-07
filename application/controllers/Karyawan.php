<?php

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['judul'] = 'Data Karyawan';
        $data['user'] = $this->ModelUser->cekData([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['karyawan'] = $this->ModelUser->getUserWhere(['role' => 'pegawai'])->result_array();

        $this->form_validation->set_rules(
            'nip',
            'NIP',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        $this->form_validation->set_rules(
            'nama',
            'Nama Karyawan',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'jabatan',
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

        if (! $this->form_validation->run()) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('karyawan/index', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $nip = $this->input->post('nip', true);

            $data = [
                'nip' => $nip,
                'nama' => $this->input->post('nama', true),
                'jabatan' => $this->input->post('jabatan', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'password' => password_hash(
                    'sidikar-' . $nip,
                    PASSWORD_BCRYPT
                ),
                'role' => 'pegawai'
            ];

            $this->ModelUser->simpanData($data);
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Karyawan Berhasil Ditambahkan</div>"
            );
            redirect(base_url('karyawan'));
        }
    }

    public function ubahKaryawan() {
        $data['judul'] = 'Ubah Data Karyawan';
        $data['user'] = $this->ModelUser->cekData([
            'nip' => $this->session->userdata('nip')
        ])->row_array();
        $data['karyawan'] = $this->ModelUser->getUserWhere([
            'id' => $this->uri->segment(3)
        ])->row_array();
        
        $this->form_validation->set_rules(
            'nip',
            'NIP',
            'required|numeric', [
                'required' => '%s harus diisi!',
                'numeric' => '%s hanya boleh berisikan angka!',
        ]);

        $this->form_validation->set_rules(
            'nama',
            'Nama Karyawan',
            'required|trim', [
                'required' => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules(
            'jabatan',
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
            $this->load->view('karyawan/ubah-karyawan', $data);
            $this->load->view('admin/templates/footer');
        } else {

            $nip = $this->input->post('nip', true);

            $data = [
                'nip' => $nip,
                'nama' => $this->input->post('nama', true),
                'jabatan' => $this->input->post('jabatan', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'password' => password_hash(
                    'sidikar-' . $nip,
                    PASSWORD_BCRYPT
                ),
            ];

            // Update Karyawan Data
            $this->db->where([
                'id' => $this->uri->segment(3)
            ]);
            $this->db->update('users', $data);
            
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-success alert-message' role='alert'>Karyawan Berhasil Diperbarui</div>"
            );

            redirect(base_url('karyawan'));
        }
    }

    public function hapusKaryawan()
    {
        $this->ModelUser->hapusUser([
            'id' => $this->uri->segment(3)
        ]);

        $this->session->set_flashdata(
            'pesan',
            "<div class='alert alert-success alert-message' role='alert'>Karyawan Berhasil Dihapus</div>"
        );
        
        redirect(base_url('karyawan'));
    }
}
