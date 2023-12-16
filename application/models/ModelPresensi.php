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

    public function cariPresensiKaryawan($select = '*', $where = null)
    {
        $this->db->select($select);
        $this->db->from($this->tabel);
        $this->db->where($where);

        return $this->db->get();
    }

    public function cariPresensiJoinKaryawan($where = null)
    {
        $this->db->select([
            'presensi.*',
            'users.nama',
            'users.nip'
        ]);

        $this->db->from($this->tabel);
        $this->db->join('users', 'users.id = presensi.user_id');
        $this->db->where($where);

        return $this->db->get();
    }

    public function simpanPresensi($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    public function updatePresensi($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }
}