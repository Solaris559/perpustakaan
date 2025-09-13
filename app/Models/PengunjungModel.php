<?php
namespace App\Models;

use CodeIgniter\Model;


class PengunjungModel extends Model
{
    protected $table = "pengunjung"; // nama tabel
    protected $primaryKey = "id_pengunjung"; // primary key tabel

    // Tambahkan allowedFields untuk kolom yang boleh diisi / diupdate
    protected $allowedFields = [
        'tanggal_kunjungan',
        'id_anggota',
    ];

    public function getPengunjung()
    {
        return $this->db->table('pengunjung')
            ->select('pengunjung.*, anggota.nama, anggota.no_anggota')
            ->join('anggota', 'anggota.id_anggota = pengunjung.id_anggota', 'left')
            ->get()
            ->getResultArray();
    }


    public function insertPengunjung($data)
    {
        return $this->db->table("pengunjung")->insert($data);
    }

    public function updatePengunjung($id_pengunjung, $data)
    {
        return $this->db->table("pengunjung")->where("id_pengunjung", $id_pengunjung)->update($data);
    }


    public function deletePengunjung($id_pengunjung)
    {
        return $this->db->table("pengunjung")->where("id_pengunjung", $id_pengunjung)->delete();
    }


    public function countPengunjung()
    {
        return $this->db->table('pengunjung')->countAll();
    }

    public function getPengunjungById($id_pengunjung)
    {
        return $this->db->table('pengunjung')->where('id_pengunjung', $id_pengunjung)->get()->getRowArray();
    }
}