<?php

class ModelJadwalPresensi extends CI_Model
{
    protected $tabel = 'jadwal_presensi';

    public function cariSemuaJadwalPresensi()
    {
        return $this->db->get($this->tabel)->result_array();
    }

    public function cariJadwalPresensi($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }

    public function updateJadwalPresensi($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }
}