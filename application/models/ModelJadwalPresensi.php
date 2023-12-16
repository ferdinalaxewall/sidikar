<?php

class ModelJadwalPresensi extends CI_Model
{
    protected $tabel = 'jadwal_presensi';

    // Fungsi untuk mencari semua data jadwal presensi
    public function cariSemuaJadwalPresensi()
    {
        return $this->db->get($this->tabel)->result_array();
    }

    // Fungsi untuk mencari data jadwal presensi dengan kondisi tertentu
    public function cariJadwalPresensi($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }

    // Fungsi untuk memperbarui data jadwal presensi
    public function updateJadwalPresensi($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }
}