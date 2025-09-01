<?php
namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';             // nama tabel
    protected $primaryKey = 'id_anggota';     // primary key tabel sesuai DB
    protected $allowedFields = ['nama', 'no_anggota', 'kelas', 'no_hp', 'kode_qr'];

    public function getAnggota()
    {
        return $this->findAll();  // cukup findAll() saja sudah otomatis pakai primary key
    }

    public function insertAnggota($data)
    {
        return $this->insert($data);  // pakai method model bawaan
    }

    public function updateAnggota($id_anggota, $data)
    {
        return $this->update($id_anggota, $data);
    }

    public function deleteAnggota($id_anggota)
    {
        return $this->delete($id_anggota);
    }

    public function countAnggota()
    {
        return $this->countAll();
    }

    // Tambahan fungsi untuk ambil data per ID (dipakai di controller)
    public function getById($id_anggota)
    {
        return $this->find($id_anggota);
    }

    // Tambahan fungsi ambil semua data sebagai array (kalau diperlukan)
    public function getAll()
    {
        return $this->findAll();
    }
}
