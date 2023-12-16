<?php

class Presensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Fungsi untuk memproses data presensi kehadiran
    public function kehadiran()
    {
        $nip = $this->uri->segment(3);
        $user = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        $jadwalHariIni = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l')
        ])->row_array();

        // Validasi lokasi presensi kehadiran
        $this->form_validation->set_rules(
            'lokasi_masuk',
            'Lokasi Presensi Kehadiran',
            'required', [
                'required' => '%s Tidak Terdeteksi, Silahkan Refresh Kembali'
        ]);

        if ($this->form_validation->run()) {

            // Cek Jadwal Presensi Hari ini
            if (!is_null($jadwalHariIni)) {

                // Cek Apakah NIP sama dengan akun yg login
                if ($nip == $user['nip']) {

                    $dataPresensiHariIni = $this->ModelPresensi->cariPresensi([
                        'user_id' => $user['id'],
                        'tanggal_presensi' => date('Y-m-d')
                    ])->row_array();
        
                    // Cek Apakah Sudah Presensi Kehadiran
                    if (is_null($dataPresensiHariIni)) {
        
                        $jadwal_jam_masuk = strtotime($jadwalHariIni['jam_masuk']);
                        $jadwal_jam_keluar = strtotime($jadwalHariIni['jam_keluar']);
                        $current_time = date('H:i:s');
                        $presensi_jam_masuk = strtotime($current_time);
    
                        // Set Status Presensi Berdasarkan Kondisi Waktu (Dikomparasi dengan Jadwal Kehadiran)
                        if ($presensi_jam_masuk > $jadwal_jam_masuk) {
                            $status_presensi = $this->ModelPresensi->TERLAMBAT;
                        } else if ($presensi_jam_masuk > $jadwal_jam_keluar) {
                            $status_presensi = $this->ModelPresensi->TIDAK_HADIR;
                        } else {
                            $status_presensi = $this->ModelPresensi->HADIR;
                        }
        
                        // Menyimpan Data Presensi Kehadiran kedalam database
                        $data = [
                            'user_id' => $user['id'],
                            'tanggal_presensi' => date('Y-m-d'),
                            'jam_masuk' => $current_time,
                            'lokasi_masuk' => $this->input->post('lokasi_masuk', true),
                            'jam_keluar' => NULL,
                            'status' => $status_presensi
                        ];
    
                        $this->session->set_flashdata(
                            'pesan',
                            "<div class='alert alert-success alert-message' role='alert'>Presensi Kehadiran Berhasil!!</div>"
                        );
    
                        $this->ModelPresensi->simpanPresensi($data);
                    } else {
                        $this->session->set_flashdata(
                            'pesan',
                            "<div class='alert alert-danger alert-message' role='alert'>Anda Sudah Melakukan Presensi Kehadiran!!</div>"
                        );
                    }
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-danger alert-message' role='alert'>NIP Tidak Valid</div>"
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    "<div class='alert alert-danger alert-message' role='alert'>Hari Ini Tidak Ada Jadwal Presensi</div>"
                );
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-danger alert-message' role='alert'>Lokasi Presensi Tidak Valid</div>"
            );
        }

        redirect(base_url('dashboard'));
    }

    // Fungsi untuk memproses data presensi kepulangan
    public function kepulangan()
    {
        $nip = $this->uri->segment(3);
        $user = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        $jadwalHariIni = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l')
        ])->row_array();

        // Validasi Lokasi Presensi Kepulangan
        $this->form_validation->set_rules(
            'lokasi_keluar',
            'Lokasi Presensi Kepulangan',
            'required', [
                'required' => '%s Tidak Terdeteksi, Silahkan Refresh Kembali'
        ]);

        if ($this->form_validation->run()) {

            // Cek Jadwal Presensi Hari Ini
            if (!is_null($jadwalHariIni)) {

                // Cek Apakah NIP sama dengan Akun yg Sedang Login
                if ($nip == $user['nip']) {

                    $dataPresensiHariIni = $this->ModelPresensi->cariPresensi([
                        'user_id' => $user['id'],
                        'tanggal_presensi' => date('Y-m-d')
                    ])->row_array();
                        
                    // Cek Apakah Sudah melakukan Presensi Kehadiran
                    if (!is_null($dataPresensiHariIni)) {
                        
                        // Cek Apakah Sudah melakukan Presensi Kepulangan
                        if (is_null($dataPresensiHariIni['jam_keluar'])) {
                            $current_time = date('H:i:s');
        
                            // Menyimpan Data Presensi Kepulangan kedalam Database
                            $data = [
                                'jam_keluar' => $current_time,
                                'lokasi_keluar' => $this->input->post('lokasi_keluar', true),
                            ];
        
                            $this->session->set_flashdata(
                                'pesan',
                                "<div class='alert alert-success alert-message' role='alert'>Presensi Kepulangan Berhasil!!</div>"
                            );
        
                            $this->ModelPresensi->updatePresensi($data, [
                                'id' => $dataPresensiHariIni['id']
                            ]);
                        } else {
                            $this->session->set_flashdata(
                                'pesan',
                                "<div class='alert alert-danger alert-message' role='alert'>Anda Sudah Melakukan Presensi Kepulangan!!</div>"
                            );
                        }
                    } else {
                        $this->session->set_flashdata(
                            'pesan',
                            "<div class='alert alert-danger alert-message' role='alert'>Anda Belum Melakukan Presensi Kehadiran!!</div>"
                        );
                    }
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        "<div class='alert alert-danger alert-message' role='alert'>NIP Tidak Valid</div>"
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    "<div class='alert alert-danger alert-message' role='alert'>Hari Ini Tidak Ada Jadwal Presensi</div>"
                );
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                "<div class='alert alert-danger alert-message' role='alert'>Lokasi Presensi Tidak Valid</div>"
            );
        }

        redirect(base_url('dashboard'));
    }
}