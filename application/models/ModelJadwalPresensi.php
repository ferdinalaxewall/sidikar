<?php

class ModelJadwalPresensi extends CI_Model
{
    private $tabel = 'jadwal_presensi';

    public function getJadwalPresensi()
    {
        return $this->db->get($this->tabel)->result_array();
    }

    public function getWhereJadwalPresensi($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }
}