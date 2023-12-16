<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    protected $tabel = 'users';

    // Fungsi untuk mencari data user dengan kondisi tertentu
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

    // Fungsi untuk mencari data user dengan kondisi tertentu (Where dan Where Not In)
    public function cariUserWhereNotIn(array $array_user_id = [], $where = [])
    {
        $this->db->from($this->tabel);
        $this->db->where($where);

        if (count($array_user_id) > 0) {
            $this->db->where_not_in('id', $array_user_id);
        }
            
        return $this->db->get();
    }

    // Fungsi untuk mencari data user dengan limit data
    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from($this->tabel);
        $this->db->limit(10, 0);
        
        return $this->db->get();
    }

    // Fungsi untuk menyimpan data user baru
    public function simpanUser($data = null)
    {
        $this->db->insert($this->tabel, $data);
    }

    // Fungsi untuk memperbarui data user
    public function updateUser($data = null, $where = null)
    {
        $this->db->where($where);
        $this->db->update($this->tabel, $data);
    }

    // Fungsi untuk menghapus data user    
    public function hapusUser($where = null)
    {
        $this->db->delete($this->tabel, $where);
    }
}