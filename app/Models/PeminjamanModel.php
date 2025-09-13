<?php
namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = "peminjaman"; // nama tabel
    protected $primaryKey = "id_peminjaman"; // primary key tabel
    protected $allowedFields = ['id_anggota', 'id_buku', 'jumlah_buku', 'tgl_peminjaman', 'batas_waktu'];

    public function getPeminjaman()
    {
        return $this->db->table('peminjaman p')
            ->select('p.*, a.nama, a.no_anggota, b.judul_buku, b.id_buku')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = p.id_buku')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
            ->where('pg.id_peminjaman IS NULL') // hanya yang belum dikembalikan
            ->get()
            ->getResultArray();
    }

    public function insertPeminjaman($data)
    {
        return $this->db->table("peminjaman")->insert($data);
    }

    // Di PeminjamanModel
    public function getPeminjamanById($id_peminjaman)
    {
        return $this->db->table('peminjaman p')
            ->select('p.*, a.nama, a.no_anggota, a.no_hp, b.judul_buku, b.id_buku')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = p.id_buku')
            ->where('p.id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();
    }



    public function updatePeminjaman($id_peminjaman, $data)
    {
        return $this->db->table("peminjaman")->where("id_peminjaman", $id_peminjaman)->update($data);
    }

    public function deletePeminjaman($id_peminjaman)
    {
        return $this->db->table("peminjaman")->where("id_peminjaman", $id_peminjaman)->delete();
    }

    public function countPeminjaman()
    {
        return $this->db->table('peminjaman p')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
            ->where('pg.id_peminjaman IS NULL')
            ->countAllResults();
    }


    public function getPeminjamanSelesai()
    {
        return $this->db->table('peminjaman p')
            ->select('p.*, pg.status as status_pengembalian, pg.tanggal_pengembalian')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman')
            ->get()
            ->getResultArray();
    }

    public function hasUnfinishedLoan($id_anggota)
    {
        $builder = $this->db->table('peminjaman');
        $builder->select('peminjaman.id_peminjaman');
        $builder->where('peminjaman.id_anggota', $id_anggota);

        // LEFT JOIN dengan tabel pengembalian, cari peminjaman yang belum ada pengembalian
        $builder->join('pengembalian', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left');
        $builder->where('pengembalian.id_peminjaman IS NULL');

        $query = $builder->get();
        return $query->getRow(); // Jika ada berarti masih ada peminjaman belum selesai
    }

    public function getLateReturns()
    {
        $today = date('Y-m-d');
        return $this->db->table('peminjaman p')
            ->select('p.id_peminjaman, a.nama, a.no_hp, b.judul_buku, p.batas_waktu')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = p.id_buku')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
            ->where('pg.id_peminjaman IS NULL')  // belum dikembalikan
            ->where('p.batas_waktu <', $today)   // lewat batas waktu
            ->get()
            ->getResultArray();
    }

    public function getPeminjamanMendekatiBatas($hariSisa = 3)
    {
        $target_date = date('Y-m-d', strtotime("+$hariSisa days"));

        return $this->db->table('peminjaman p')
            ->select('p.*, a.nama, a.no_hp, b.judul_buku')
            ->join('anggota a', 'a.id_anggota = p.id_anggota')
            ->join('buku b', 'b.id_buku = p.id_buku')
            ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
            ->where('pg.id_peminjaman IS NULL')        // Belum dikembalikan
            ->where('p.batas_waktu', $target_date)    // Batas waktu tepat 3 hari lagi
            ->get()
            ->getResultArray();
    }

    public function getPeminjamanPerBulan()
    {
        $builder = $this->db->table('peminjaman');
        $builder->select('MONTH(tgl_peminjaman) as bulan, COUNT(*) as total');
        $builder->groupBy('bulan');
        $builder->orderBy('bulan', 'ASC');
        $query = $builder->get();

        $result = array_fill(1, 12, 0); // Inisialisasi semua bulan dari Jan (1) sampai Des (12)

        foreach ($query->getResult() as $row) {
            $result[(int) $row->bulan] = (int) $row->total;
        }

        return array_values($result); // Kembalikan dalam bentuk array urut Januari–Desember
    }
}