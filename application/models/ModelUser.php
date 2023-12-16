<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    protected $tabel = 'users';

    public function cariUser($where = null)
    {
        $this->db->select([
            'users.*',
            'nama_jabatan',
            'min_jam_kerja'
        ]);
        
        $this->db->from($this->tabel);
        $this->db->join('jabatan', 'jabatan.id = users.id_jabatan');
        $this->db->where($where);

        return $this->db->get();
    }

    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from($this->tabel);
        $this->db->limit(10, 0);
        
        return $this->db->get();
    }

    public function simpanUser($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    public function updateUser($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }

    public function hapusUser($where = null)
    {
        $this->db->delete($this->tabel, $where);
    }
}