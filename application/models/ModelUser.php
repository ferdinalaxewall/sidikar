<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    private $tabel = 'users';

    public function simpanData($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }

    public function getUserWhere($where = null)
    {
        var_dump($where);
        return $this->db->get_where($this->tabel, $where);
    }
    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
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
}