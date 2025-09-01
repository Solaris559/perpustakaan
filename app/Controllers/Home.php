<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;

use App\Models\PetugasModel;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class Home extends BaseController
{
    // Declare models
    // These models are used to interact with the database for various operations.
    protected $PetugasModel;
    protected $AnggotaModel;
    protected $BukuModel;
    protected $PeminjamanModel;

    // Constructor
    // This method initializes the models and loads necessary helpers.
    // It is called automatically when an instance of the Home controller is created.
    public function __construct()
    {
        helper("form");
        $this->PetugasModel = new PetugasModel();
        $this->AnggotaModel = new AnggotaModel();
        $this->BukuModel = new BukuModel();
        $this->PeminjamanModel = new PeminjamanModel();
    }

    // Login method
    // This method displays the login view.
    public function login()
    {
        return view('v_login');

    }

    // Cek login method
    // This method checks the username and password against the database.
    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cekLogin = $this->PetugasModel->cekLogin($username, $password);

        if ($cekLogin !== null) {
            session()->set('username', $cekLogin['username']);
            session()->set('nama', $cekLogin['nama']);
            session()->set('role', $cekLogin['role']);
            return redirect()->to('/home/index');
        } else {
            session()->setFlashdata('gagal', 'Username atau Password Anda Salah !');
            return redirect()->to('/');
        }
    }

    // Logout method
    // This method destroys the session and redirects the user to the login page.
    public function logout()
    {
        session()->setFlashdata('success', 'Anda Berhasil Logout !');
        session()->remove(['username', 'nama', 'role']);
        return redirect()->to('/');
    }

    // Dashboard method
    // This method displays the dashboard with counts of anggota, buku, peminjaman, and denda.
    public function index()
    {
        if (session()->get('username') == '') {
            // User is not logged in, redirect to login page
            session()->setFlashdata('gagal', 'Anda Belum Login !');
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Dashboard',
            'jumlah_anggota' => $this->AnggotaModel->countAnggota(),
            'jumlah_buku' => $this->BukuModel->countBuku(),
            'jumlah_peminjaman' => $this->PeminjamanModel->countPeminjaman(),
            'jumlah_denda' => 0,
            'isi' => 'v_dashboard',
        ];
        return view('layout/v_wrapper', $data);

    }

    // Anggota methods
    // These methods handle the operations related to anggota (members) such as viewing, adding, editing, and deleting members.
    public function anggota()
    {
        $data = [
            'title' => 'Data Anggota',
            'anggota' => $this->AnggotaModel->getAnggota(),
            'isi' => 'v_anggota',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_anggota()
    {
        $nama = $this->request->getPost('nama');
        $no_anggota = $this->request->getPost('no_anggota');
        $kelas = $this->request->getPost('kelas');

        // Buat isi QR code
        $qrContent = "Nama: $nama\nNo Anggota: $no_anggota\nKelas: $kelas";

        // Buat QR Code dengan opsi langsung di konstruktor
        $qrCode = new QrCode($qrContent);

        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Simpan QR code ke file di folder public/template/dist/assets/qr_codes
        $qrFilename = 'qr_' . uniqid() . '.png';
        $qrPath = FCPATH . 'template/dist/assets/qr_codes/' . $qrFilename;
        $qrImage->saveToFile($qrPath);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_anggota' => $this->request->getPost('no_anggota'),
            'kelas' => $this->request->getPost('kelas'),
            'no_hp' => $this->request->getPost('no_hp'),
            'kode_qr' => $qrFilename,
        ];

        $this->AnggotaModel->insertAnggota($data);

        session()->setFlashdata('success', 'Data Anggota Berhasil Ditambahkan');
        return redirect()->to('/home/anggota');
    }


    public function edit_anggota($id_anggota)
    {
        $nama = $this->request->getPost('nama');
        $no_anggota = $this->request->getPost('no_anggota');
        $kelas = $this->request->getPost('kelas');

        // Buat isi QR code
        $qrContent = "Nama: $nama\nNo Anggota: $no_anggota\nKelas: $kelas";

        // Buat QR Code dengan opsi langsung di konstruktor
        $qrCode = new QrCode($qrContent);

        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Simpan QR code ke file di folder public/template/dist/assets/qr_codes
        $qrFilename = 'qr_' . uniqid() . '.png';
        $qrPath = FCPATH . 'template/dist/assets/qr_codes/' . $qrFilename;
        $qrImage->saveToFile($qrPath);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_anggota' => $this->request->getPost('no_anggota'),
            'kelas' => $this->request->getPost('kelas'),
            'no_hp' => $this->request->getPost('no_hp'),
            'kode_qr' => $qrFilename,
        ];

        $this->AnggotaModel->updateAnggota($id_anggota, $data);

        session()->setFlashdata('success', 'Data Anggota Berhasil Diedit');
        return redirect()->to('/home/anggota');
    }

    public function hapus_anggota($id_anggota)
    {
        $this->AnggotaModel->deleteAnggota($id_anggota);

        session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus');
        return redirect()->to('/home/anggota');
    }

    public function cetak_kartu($id)
    {
        $anggota = $this->AnggotaModel->getById($id);
        if (is_array($anggota)) {
            $anggota = (object) $anggota;
        }

        $html = view('kartu_template', ['anggota' => $anggota]);

        $mpdf = new \Mpdf\Mpdf([
            'format' => [86, 54],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0
        ]);

        $mpdf->WriteHTML($html);

        // Output langsung ke browser (inline)
        $mpdf->Output("Kartu_{$anggota->nama}.pdf", 'I');
        exit;  // Penting agar skrip berhenti dan tidak mencetak apapun lagi
    }



    public function cetak_semua_kartu()
    {
        $anggota = $this->AnggotaModel->getAll();

        $mpdf = new \Mpdf\Mpdf([
            'format' => [86, 54],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0
        ]);

        foreach ($anggota as $data) {
            $html = view('kartu_template', ['anggota' => (object) $data]);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
        }

        $mpdf->Output("Semua_Kartu_Anggota.pdf", 'I');
    }



    // Buku methods
    // These methods handle the operations related to buku (books) such as viewing, adding, editing, and deleting books.
    public function buku()
    {
        $data = [
            'title' => 'Data Buku',
            'buku' => $this->BukuModel->getBuku(),
            'isi' => 'v_buku',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_buku()
    {
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul && $fileSampul->isValid()) {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('template/dist/assets/covers', $namaFile);
            $sampul = $namaFile;
        } else {
            // Kalau tidak upload, pakai default cover
            $sampul = 'default-cover.png';
        }

        $data = [
            'sampul' => $sampul,
            'judul_buku' => $this->request->getPost('judul_buku'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'kota' => $this->request->getPost('kota'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jilid' => $this->request->getPost('jilid'),
            'jumlah_buku' => $this->request->getPost('jumlah_buku'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'katalog' => $this->request->getPost('katalog'),
            'jumlah_halaman' => $this->request->getPost('jumlah_halaman'),
            'isbn' => $this->request->getPost('isbn'),
        ];
        // Insert data into buku table
        $this->BukuModel->insertBuku($data);
        // Set flashdata message for success
        session()->setFlashdata('success', 'Data Buku Berhasil Ditambahkan');
        // Redirect to buku page after insertion
        return redirect()->to('/home/buku');
    }

    public function edit_buku($id_buku)
    {
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul && $fileSampul->isValid()) {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('template/dist/assets/covers', $namaFile);
            $sampul = $namaFile;
        } else {
            // Kalau tidak upload, pakai default cover
            $sampul = 'default-cover.png';
        }

        $data = [
            'sampul' => $sampul,
            'judul_buku' => $this->request->getPost('judul_buku'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'kota' => $this->request->getPost('kota'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jilid' => $this->request->getPost('jilid'),
            'jumlah_buku' => $this->request->getPost('jumlah_buku'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'katalog' => $this->request->getPost('katalog'),
            'jumlah_halaman' => $this->request->getPost('jumlah_halaman'),
            'isbn' => $this->request->getPost('isbn'),
        ];
        // Insert data into buku table
        $this->BukuModel->updateBuku($id_buku, $data);
        // Set flashdata message for success
        session()->setFlashdata('success', 'Data Buku Berhasil Diedit');
        // Redirect to buku page after insertion
        return redirect()->to('/home/buku');
    }

    public function hapus_buku($id_buku)
    {
        $this->BukuModel->deleteBuku($id_buku);

        session()->setFlashdata('success', 'Data Buku Berhasil Dihapus');
        return redirect()->to('/home/buku');

    }

    // Peminjaman methods
    // These methods handle the operations related to peminjaman (loans) such as viewing, adding, editing, and deleting loans.
    public function peminjaman()
    {
        $data = [
            'title' => 'Data Peminjaman',
            'peminjaman' => $this->PeminjamanModel->getPeminjaman(),
            'buku' => $this->BukuModel->getBuku(),
            'isi' => 'v_peminjaman',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_peminjaman()
    {
        $judul = $this->request->getPost('judul'); // Judul buku dari form
        $jumlah = (int) $this->request->getPost('jumlah'); // Jumlah yang ingin dipinjam

        // Ambil data buku berdasarkan judul
        $buku = $this->BukuModel->getBukuByJudul($judul); // Kamu harus punya method ini

        if (!$buku) {
            session()->setFlashdata('gagal', 'Buku tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        if ($buku['jumlah_buku'] < $jumlah) {
            session()->setFlashdata('gagal', 'Stok buku tidak mencukupi.');
            return redirect()->to('/home/peminjaman');
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_anggota' => $this->request->getPost('no_anggota'),
            'judul' => $judul,
            'jumlah' => $jumlah,
            'tgl_peminjaman' => $this->request->getPost('tgl_peminjaman'),
            'batas_waktu' => $this->request->getPost('batas_waktu'),
        ];
        // Insert data into buku table
        $this->PeminjamanModel->insertPeminjaman($data);

        // Update the jumlah_buku in buku table
        // Assuming you have a method to get buku by judul
        // and a method to update buku
        // This will reduce the jumlah_buku by the jumlah that was borrowed
        // Assuming $buku is an associative array with 'id' and 'jumlah_buku
        $sisa = $buku['jumlah_buku'] - $jumlah;
        $this->BukuModel->updateBuku($buku['id'], ['jumlah_buku' => $sisa]);

        // Set flashdata message for success
        session()->setFlashdata('success', 'Data Peminjaman Berhasil Ditambahkan');
        // Redirect to buku page after insertion
        return redirect()->to('/home/peminjaman');
    }

    public function edit_peminjaman()
    {
        $data = [
            'title' => 'Edit Peminjaman',
            'isi' => 'v_peminjaman',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function hapus_peminjaman()
    {
        $data = [
            'title' => 'Hapus Peminjaman',
            'isi' => 'v_peminjaman',
        ];
        return view('layout/v_wrapper', $data);
    }

    // Pengembalian methods
    // These methods handle the operations related to pengembalian (returns) such as viewing, adding, editing, and deleting returns.
    public function pengembalian()
    {
        $data = [
            'title' => 'Data Pengembalian',
            'isi' => 'v_pengembalian',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_pengembalian()
    {
        $data = [
            'title' => 'Tambah Pengembalian',
            'isi' => 't_pengembalian',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function edit_pengembalian()
    {
        $data = [
            'title' => 'Edit Pengembalian',
            'isi' => 'v_pengembalian',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function hapus_pengembalian()
    {
        $data = [
            'title' => 'Hapus Pengembalian',
            'isi' => 'v_pengembalian',
        ];
        return view('layout/v_wrapper', $data);
    }

    // Denda methods
    // These methods handle the operations related to denda (fines) such as viewing, adding, editing, and deleting fines.
    public function denda()
    {
        $data = [
            'title' => 'Data Denda',
            'isi' => 'v_denda',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_denda()
    {
        $data = [
            'title' => 'Tambah Denda',
            'isi' => 't_denda',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function edit_denda()
    {
        $data = [
            'title' => 'Edit Denda',
            'isi' => 'v_denda',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function hapus_denda()
    {
        $data = [
            'title' => 'Hapus Denda',
            'isi' => 'v_denda',
        ];
        return view('layout/v_wrapper', $data);
    }
}
