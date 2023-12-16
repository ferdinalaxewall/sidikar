<?php

class ModelPresensi extends CI_Model
{
    protected $tabel = 'presensi';

    public $TIDAK_HADIR = 1;
    public $HADIR = 2;
    public $TERLAMBAT = 3;

    public function cariPresensi($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }

    public function simpanPresensi($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

}