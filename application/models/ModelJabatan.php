<?php

class ModelJabatan extends CI_Model
{
    protected $tabel = 'jabatan';

    // Fungsi untuk mencari data semua jabatan
    public function cariSemuaJabatan()
    {
        return $this->db->get($this->tabel)->result_array();
    }

    // Fungsi untuk mencari data jabatan dengan kondisi tertentu
    public function cariJabatan($where = null)
    {
        return $this->db->get_where($this->tabel, $where);
    }

    // Fungsi untuk menyimpan data jabatan baru
    public function simpanJabatan($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    // Fungsi untuk memperbarui data jabatan
    public function updateJabatan($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }

    // Fungsi untuk menghapus data jabatan
    public function hapusJabatan($where = null)
    {
        $this->db->delete($this->tabel, $where);
    }
}