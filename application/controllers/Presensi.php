<?php

class Presensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function kehadiran()
    {
        $nip = $this->uri->segment(3);
        $user = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        $jadwalHariIni = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l')
        ])->row_array();

        if (!is_null($jadwalHariIni)) {
            if ($nip == $user['nip']) {
                $dataPresensiHariIni = $this->ModelPresensi->cariPresensi([
                    'tanggal_presensi' => date('Y-m-d')
                ])->row_array();
    
                if (is_null($dataPresensiHariIni)) {
    
                    $jadwal_jam_masuk = strtotime($jadwalHariIni['jam_masuk']);
                    $jadwal_jam_keluar = strtotime($jadwalHariIni['jam_keluar']);
                    $current_time = date('H:i:s');
                    $presensi_jam_masuk = strtotime($current_time);

                    if ($presensi_jam_masuk > $jadwal_jam_masuk) {
                        $status_presensi = $this->ModelPresensi->TERLAMBAT;
                    } else if ($presensi_jam_masuk > $jadwal_jam_keluar) {
                        $status_presensi = $this->ModelPresensi->TIDAK_HADIR;
                    } else {
                        $status_presensi = $this->ModelPresensi->HADIR;
                    }
    
                    $data = [
                        'user_id' => $user['id'],
                        'tanggal_presensi' => date('Y-m-d'),
                        'jam_masuk' => $current_time,
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

        redirect(base_url('dashboard'));
    }

    public function kepulangan()
    {
        $nip = $this->uri->segment(3);
        $user = $this->ModelUser->cariUser([
            'nip' => $this->session->userdata('nip')
        ])->row_array();

        $jadwalHariIni = $this->ModelJadwalPresensi->cariJadwalPresensi([
            'hari' => date('l')
        ])->row_array();
    }
}