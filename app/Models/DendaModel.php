<?php
namespace App\Models;

use CodeIgniter\Model;

class DendaModel extends Model
{
    protected $table = 'denda';
    protected $primaryKey = 'id_denda';
    protected $allowedFields = [
        'id_pengembalian',
        'jumlah_denda',
        'status_denda',
        'tanggal_pembayaran',
        'keterangan'
    ];

    // Fungsi untuk mengambil data denda beserta nama anggota, no anggota, nilai ganti dan status denda
    public function getDendaWithDetails()
    {
        return $this->db->table('denda')
            ->select('anggota.nama, anggota.no_anggota, pengembalian.nilai_ganti, denda.status_denda')
            ->join('pengembalian', 'denda.id_pengembalian = pengembalian.id_pengembalian')
            ->join('peminjaman', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman')
            ->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')
            ->where('pengembalian.nilai_ganti IS NOT NULL')
            ->get()
            ->getResultArray();
    }

    public function getDendaWithAnggota()
    {
        return $this->db->table('denda d')
            ->select('d.id_denda, d.jumlah_denda, d.status_denda, d.tanggal_pembayaran, d.keterangan, a.nama, a.no_anggota, p.nilai_ganti')
            ->join('pengembalian p', 'd.id_pengembalian = p.id_pengembalian')
            ->join('peminjaman pm', 'p.id_peminjaman = pm.id_peminjaman')
            ->join('anggota a', 'pm.id_anggota = a.id_anggota')
            ->get()
            ->getResultArray();
    }

    public function countBelumLunas()
    {
        return $this->where('status_denda', 'belum lunas')->countAllResults();
    }


}
