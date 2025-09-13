<?php
namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = "pengembalian";
    protected $primaryKey = "id_pengembalian";

    protected $allowedFields = [
        'id_peminjaman',
        'status',
        'tanggal_pengembalian',
        'jenis_ganti',
        'nilai_ganti',
    ];

    // insert pengembalian
    public function insertPengembalian($data)
    {
        if (empty($data)) {
            return false;
        }
        return $this->insert($data);
    }

    // update pengembalian
    public function updatePengembalian($id, $data)
    {
        if (empty($data)) {
            return false;
        }
        return $this->update($id, $data);
    }

    // ambil semua data dengan relasi
    // public function getAllPengembalian()
    // {
    //     return $this->db->table('pengembalian pg') // gunakan alias 'pg' untuk pengembalian
    //         ->select('pg.id_pengembalian, pg.status, pg.tanggal_pengembalian, 
    //               pg.nilai_ganti, pg.jenis_ganti,
    //               p.jumlah_buku, p.tgl_peminjaman, p.batas_waktu,
    //               a.nama, a.no_anggota,
    //               b.judul_buku')
    //         ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman')
    //         ->join('anggota a', 'a.id_anggota = p.id_anggota')
    //         ->join('buku b', 'b.id_buku = p.id_buku')
    //         ->orderBy('pg.tanggal_pengembalian', 'DESC')
    //         ->get()
    //         ->getResultArray();
    // }

    public function getAllPengembalian()
    {
        return $this->db->table('pengembalian pg')
            ->select('pg.id_pengembalian, pg.status, pg.tanggal_pengembalian, 
                  pg.nilai_ganti, pg.jenis_ganti,
                  p.jumlah_buku, p.tgl_peminjaman, p.batas_waktu,
                  a.nama, a.no_anggota,
                  b.judul_buku,
                  d.jumlah_denda') // tambahkan ini
            ->join('peminjaman p', 'p.id_peminjaman = pg.id_peminjaman')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = p.id_buku')
            ->join('denda d', 'd.id_pengembalian = pg.id_pengembalian', 'left') // JOIN denda
            ->orderBy('pg.tanggal_pengembalian', 'DESC')
            ->get()
            ->getResultArray();
    }


    public function getAllPengembalianWithDenda()
    {
        return $this->db->table('pengembalian')
            ->select('pengembalian.*, peminjaman.id_anggota, peminjaman.id_buku, peminjaman.jumlah_buku, peminjaman.tgl_peminjaman, peminjaman.batas_waktu, anggota.nama, buku.judul_buku, denda.jumlah_denda')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku')
            ->join('denda', 'denda.id_pengembalian = pengembalian.id_pengembalian', 'left') // JOIN denda
            ->get()
            ->getResultArray();
    }

    public function getPengembalianPerBulan()
    {
        $builder = $this->db->table('pengembalian');
        $builder->select('MONTH(tanggal_pengembalian) as bulan, COUNT(*) as total');
        $builder->groupBy('bulan');
        $builder->orderBy('bulan', 'ASC');
        $query = $builder->get();

        $result = array_fill(1, 12, 0);

        foreach ($query->getResult() as $row) {
            $result[(int) $row->bulan] = (int) $row->total;
        }

        return array_values($result);
    }
}
