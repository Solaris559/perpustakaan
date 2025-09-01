<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    public function getBuku()
    {
        return $this->db->table("buku")->get()->getResultArray();
    }

    public function insertBuku($data)
    {
        return $this->db->table("buku")->insert($data);
    }

    public function updateBuku($id_buku, $data)
    {
        return $this->db->table("buku")->where("id_buku", $id_buku)->update($data);
    }

    public function deleteBuku($id_buku)
    {
        return $this->db->table("buku")->where("id_buku", $id_buku)->delete();
    }

    public function countBuku()
    {
        // This method counts the number of buku (books) in the database.
        // It returns the count as an integer.
        return $this->db->table('buku')->countAll();
    }

    public function getBukuByJudul($judul)
    {
        // This method retrieves a book record based on its title.
        // It returns the first matching record as an associative array.
        // If no record is found, it returns null.
        return $this->db->table('buku')
            ->where('judul_buku', $judul)
            ->get()
            ->getRowArray();
    }
}