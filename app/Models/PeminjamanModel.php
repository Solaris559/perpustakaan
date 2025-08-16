<?php
namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = "peminjaman"; // nama tabel
    protected $primaryKey = "id"; // primary key tabel
    protected $allowedFields = ['nama', 'no_anggota', 'judul', 'jumlah', 'tgl_peminjaman', 'batas_waktu'];
    public function getPeminjaman()
    {
        return $this->db->table("peminjaman")->get()->getResultArray();
    }

    public function insertPeminjaman($data)
    {
        return $this->db->table("peminjaman")->insert($data);
    }

    public function countPeminjaman()
    {
        return $this->db->table("peminjaman")->countAll();
    }
}