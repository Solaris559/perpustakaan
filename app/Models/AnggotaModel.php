<?php
namespace App\Models;

use CodeIgniter\Model;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class AnggotaModel extends Model
{
    protected $table = 'anggota';             // nama tabel
    protected $primaryKey = 'id_anggota';     // primary key tabel sesuai DB
    protected $allowedFields = ['nama', 'no_anggota', 'jenis_kelamin', 'kelas', 'no_hp', 'kode_qr'];

    public function getAnggota()
    {
        return $this->findAll();  // cukup findAll() saja sudah otomatis pakai primary key
    }

    // AnggotaModel.php
    public function getAnggotaByNama($nama)
    {
        return $this->db->table('anggota')->where('nama', $nama)->get()->getRowArray();
    }

    public function getLastNoAnggota()
    {
        $builder = $this->db->table('anggota');
        $builder->selectMax('no_anggota');
        $query = $builder->get();
        $result = $query->getRowArray();
        return $result ? $result['no_anggota'] : null;
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

    // Fungsi untuk naikkan kelas semua anggota dan update QR Code
    // serta hapus anggota yang sudah kelas 10 ke atas
    public function updateKelasAnggota()
    {
        $kelasBaru = [
            '9A' => 'Alumni',
            '9B' => 'Alumni',
            '9C' => 'Alumni',
            '8A' => '9A',
            '8B' => '9B',
            '8C' => '9C',
            '7A' => '8A',
            '7B' => '8B',
            '7C' => '8C',

        ];

        foreach ($kelasBaru as $kelasLama => $kelasNaik) {
            // Ambil anggota dengan kelas lama
            $anggotaList = $this->where('kelas', $kelasLama)->findAll();

            foreach ($anggotaList as $anggota) {
                if ($kelasNaik === 'Alumni') {
                    // Jika kelas baru adalah Alumni, hapus data anggota dan peminjaman terkait
                    $this->hapusPeminjamanByAnggota($anggota['id_anggota']);
                    $this->delete($anggota['id_anggota']);
                } else {
                    // Update kelas dan buat QR baru
                    $qrContent = "Nama: {$anggota['nama']}\nNo Anggota: {$anggota['no_anggota']}\nKelas: {$kelasNaik}";

                    $qrCode = new QrCode($qrContent);
                    $writer = new PngWriter();
                    $qrImage = $writer->write($qrCode);

                    $qrFilename = 'qr_' . uniqid() . '.png';
                    $qrPath = FCPATH . 'template/dist/assets/qr_codes/' . $qrFilename;
                    $qrImage->saveToFile($qrPath);

                    $this->update($anggota['id_anggota'], [
                        'kelas' => $kelasNaik,
                        'kode_qr' => $qrFilename
                    ]);
                }
            }
        }
    }

    public function hapusPeminjamanByAnggota($id_anggota)
    {
        return $this->db->table('peminjaman')->where('id_anggota', $id_anggota)->delete();
    }

    public function getAnggotaPerKelas()
    {
        $builder = $this->db->table('anggota');
        $builder->select('kelas, COUNT(*) as total');
        $builder->groupBy('kelas');
        $query = $builder->get();

        $result = [];
        foreach ($query->getResult() as $row) {
            $result[$row->kelas] = (int) $row->total;
        }

        return $result;
    }


}
