<?php
namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';     // nama tabel
    protected $primaryKey = 'id';      // primary key tabel

    // Kolom-kolom yang diizinkan untuk diisi melalui insert/update
    protected $allowedFields = ['nama', 'no_anggota', 'kelas', 'kode_qr'];
    public function getAnggota()
    {
        // return $this->findAll();
        return $this->db->table('anggota')->get()->getResultArray();
    }

    public function insertAnggota($data)
    {
        return $this->db->table("anggota")->insert($data);
    }

    public function updateAnggota($id, $data)
    {
        return $this->db->table("anggota")->where("id", $id)->update($data);
    }

    public function deleteAnggota($id)
    {
        return $this->db->table("anggota")->where("id", $id)->delete();
    }

    public function countAnggota()
    {
        // This method counts the number of anggota (members) in the database.
        // It returns the count as an integer.
        return $this->db->table('anggota')->countAll();
    }
}
