<?php

class ModelJabatan extends CI_Model
{
    protected $tabel = 'jabatan';

    public function cariSemuaJabatan()
    {
        return $this->db->get($this->tabel)->result_array();
    }

    public function cariJabatan()
    {
        return $this->db->get_where($this->tabel);
    }

    public function simpanJabatan($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    public function updateJabatan($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }

    public function hapusJabatan($where = null)
    {
        $this->db->delete($this->tabel, $where);
    }
}