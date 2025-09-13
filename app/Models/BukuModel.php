<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = "buku"; // nama tabel
    protected $primaryKey = "id_buku"; // primary key tabel

    // Tambahkan allowedFields untuk kolom yang boleh diisi / diupdate
    protected $allowedFields = [
        'sampul',
        'judul_buku',
        'pengarang',
        'penerbit',
        'kota',
        'tahun_terbit',
        'jilid',
        'jumlah_buku',
        'harga_satuan',
        'katalog',
        'rak',
        'jumlah_halaman',
        'isbn'
    ];

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
        return $this->db->table('buku')->countAll();
    }

    public function getBukuById($id_buku)
    {
        return $this->db->table('buku')->where('id_buku', $id_buku)->get()->getRowArray();
    }

    public function getBukuByIsbn($isbn)
    {
        return $this->db->table('buku')->where('isbn', $isbn)->get()->getRowArray();
    }

    public function getKatalog()
    {
        return $this->db->table('buku')
            ->select('katalog')
            ->distinct()
            ->orderBy('katalog', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getRak()
    {
        return $this->db->table('buku')
            ->select('rak')
            ->distinct()
            ->orderBy('rak', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getFilteredBuku($katalog = null, $rak = null)
    {
        $builder = $this->db->table('buku');

        if ($katalog) {
            $builder->where('katalog', $katalog);
        }
        if ($rak) {
            $builder->where('rak', $rak);
        }
        return $builder->get()->getResultArray();
    }


}
