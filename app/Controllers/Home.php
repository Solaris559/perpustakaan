<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\PetugasModel;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\DendaModel;
use App\Models\PengunjungModel;
use Mpdf\Mpdf;

class Home extends BaseController
{
    // Declare models
    // These models are used to interact with the database for various operations.
    protected $PetugasModel;
    protected $AnggotaModel;
    protected $BukuModel;
    protected $PeminjamanModel;
    protected $PengembalianModel;
    protected $DendaModel;
    protected $PengunjungModel;

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
        $this->PengembalianModel = new PengembalianModel();
        $this->DendaModel = new DendaModel();
        $this->PengunjungModel = new PengunjungModel();
    }

    // Login method
    // This method displays the login view.
    public function login()
    {
        return view('v_login');

    }

    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $loginAttempts = session()->get('login_attempts') ?? 0;
        $blockStart = session()->get('block_time_start');

        // Jika lebih dari 3 kali gagal, cek apakah masih dalam masa blokir
        if ($loginAttempts > 3 && $blockStart) {
            $remaining = 30 - (time() - $blockStart);
            if ($remaining > 0) {
                // Masih dalam waktu blokir
                return redirect()->to('/');
            } else {
                // Reset blokir setelah waktu habis
                session()->remove('login_attempts');
                session()->remove('last_attempt_time');
                session()->remove('block_time_start');
            }
        }

        // Cek ke database
        $cekLogin = $this->PetugasModel->cekLogin($username, $password);

        if ($cekLogin !== null) {
            // Login berhasil
            session()->set([
                'id_petugas' => $cekLogin['id_petugas'],
                'foto' => $cekLogin['foto'],
                'username' => $cekLogin['username'],
                'nama' => $cekLogin['nama'],
                'role' => $cekLogin['role']
            ]);

            // Reset percobaan
            session()->remove('login_attempts');
            session()->remove('last_attempt_time');
            session()->remove('block_time_start');

            return redirect()->to('/home/index');
        } else {
            // Login gagal
            $loginAttempts++;
            session()->set('login_attempts', $loginAttempts);
            session()->set('last_attempt_time', time());

            if ($loginAttempts > 3) {
                session()->set('block_time_start', time());
                session()->setFlashdata('gagal', 'Terlalu banyak percobaan login. Silakan coba lagi dalam 30 detik.');
            } else {
                session()->setFlashdata('gagal', 'Username atau Password Anda Salah! Percobaan ke-' . $loginAttempts);
            }

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
    // public function index()
    // {
    //     if (session()->get('username') == '') {
    //         // User is not logged in, redirect to login page
    //         session()->setFlashdata('gagal', 'Anda Belum Login !');
    //         return redirect()->to('/');
    //     }

    //     $data = [
    // 'title' => 'Dashboard',
    // 'jumlah_anggota' => $this->AnggotaModel->countAnggota(),
    // 'jumlah_buku' => $this->BukuModel->countBuku(),
    // 'jumlah_peminjaman' => $this->PeminjamanModel->countPeminjaman(),
    // 'jumlah_denda' => $this->DendaModel->countBelumLunas(),
    // 'isi' => 'v_dashboard',
    //     ];
    //     return view('layout/v_wrapper', $data);

    // }

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda Belum Login !');
            return redirect()->to('/');
        }

        $bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $kelas_anggota = ['7A', '7B', '7C', '8A', '8B', '8C', '9A', '9B', '9C'];

        // Ambil data dari database
        $peminjaman_per_bulan = $this->PeminjamanModel->getPeminjamanPerBulan();
        $pengembalian_per_bulan = $this->PengembalianModel->getPengembalianPerBulan();
        $anggota_raw = $this->AnggotaModel->getAnggotaPerKelas();

        // Susun ulang data anggota sesuai urutan kelas
        $anggota_per_kelas = [];
        foreach ($kelas_anggota as $kelas) {
            $anggota_per_kelas[] = isset($anggota_raw[$kelas]) ? $anggota_raw[$kelas] : 0;
        }



        $data = [
            'title' => 'Dashboard',
            'jumlah_anggota' => $this->AnggotaModel->countAnggota(),
            'jumlah_buku' => $this->BukuModel->countBuku(),
            'jumlah_peminjaman' => $this->PeminjamanModel->countPeminjaman(),
            'jumlah_denda' => $this->DendaModel->countBelumLunas(),
            'bulan' => $bulanNama,
            'peminjaman_per_bulan' => $peminjaman_per_bulan,
            'pengembalian_per_bulan' => $pengembalian_per_bulan,
            'kelas' => $kelas_anggota,
            'anggota_per_kelas' => $anggota_per_kelas,
            'isi' => 'v_dashboard',
        ];

        return view('layout/v_wrapper', $data);
    }



    public function edit_petugas_form($id_petugas)
    {
        // Load model petugas (pastikan kamu sudah punya modelnya)
        $petugasModel = new \App\Models\PetugasModel();

        // Ambil data petugas berdasarkan id
        $data['petugas'] = $petugasModel->find($id_petugas);

        if (!$data['petugas']) {
            // Jika data tidak ditemukan, tampilkan error atau redirect
            return redirect()->to('/home/index')->with('error', 'Data petugas tidak ditemukan');
        }

        // Load view form edit petugas, kirim data petugas ke view
        return view('edit_petugas_form', $data);
    }


    public function edit_petugas($id_petugas)
    {
        $petugasModel = new \App\Models\PetugasModel();

        $data = $this->request->getPost();
        $fileFoto = $this->request->getFile('foto');

        // Ambil data petugas lama
        $petugasLama = $petugasModel->find($id_petugas);

        if (!$petugasLama) {
            return redirect()->back()->with('error', 'Petugas tidak ditemukan.');
        }

        // Handle upload foto baru jika ada
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFile = $fileFoto->getRandomName();
            $fileFoto->move('./template/dist/assets/img/', $namaFile);

            if ($petugasLama['foto'] && file_exists('./template/dist/assets/img/' . $petugasLama['foto'])) {
                unlink('./template/dist/assets/img/' . $petugasLama['foto']);
            }

            $data['foto'] = $namaFile;
        } else {
            unset($data['foto']);
        }

        // Update password jika diisi
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        // Update data petugas
        $petugasModel->update($id_petugas, $data);

        // **Update session di sini agar data user terbaru langsung tersimpan di session**
        $petugasBaru = $petugasModel->find($id_petugas);
        session()->set([
            'nama' => $petugasBaru['nama'],
            'username' => $petugasBaru['username'],
            'foto' => $petugasBaru['foto'],
        ]);

        return redirect()->to(base_url('home/index'))->with('success', 'Profil berhasil diperbarui.');
    }


    // Anggota methods
    // These methods handle the operations related to anggota (members) such as viewing, adding, editing, and deleting members.
    public function anggota()
    {
        $lastNoAnggota = $this->AnggotaModel->getLastNoAnggota();

        if ($lastNoAnggota === null) {
            $newNoAnggota = '001';
        } else {
            $newNoAnggota = str_pad((int) $lastNoAnggota + 1, 3, '0', STR_PAD_LEFT);
        }

        // Kirim data ke view
        $data = [
            'title' => 'Data Anggota',
            'anggota' => $this->AnggotaModel->getAnggota(),
            'no_anggota' => $newNoAnggota,
            'isi' => 'v_anggota',
        ];

        return view('layout/v_wrapper', $data);
    }


    public function tambah_anggota()
    {
        // Dapatkan nomor anggota terakhir
        $lastNoAnggota = $this->AnggotaModel->getLastNoAnggota();

        // Jika belum ada data, mulai dari '001'
        if ($lastNoAnggota === null) {
            $newNoAnggota = '001';
        } else {
            // Tambah 1 dan format dengan 3 digit, misalnya '002', '010', dll
            $newNoAnggota = str_pad((int) $lastNoAnggota + 1, 3, '0', STR_PAD_LEFT);
        }

        // Cek apakah nomor anggota sudah ada (hindari duplikat)
        $existing = $this->AnggotaModel->where('no_anggota', $newNoAnggota)->first();
        if ($existing) {
            session()->setFlashdata('error', 'Nomor anggota sudah ada, coba lagi.');
            return redirect()->back()->withInput();
        }

        $nama = $this->request->getPost('nama');
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $no_hp = $this->request->getPost('no_hp');
        $kelas = $this->request->getPost('kelas');

        // Buat isi QR code
        $qrContent = "Nama: $nama\nNo Anggota: $newNoAnggota\nJenis Kelamin: $jenis_kelamin\nNo. HP: $no_hp\nKelas: $kelas";

        $qrCode = new QrCode($qrContent);
        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        $qrFilename = 'qr_' . uniqid() . '.png';
        $qrPath = FCPATH . 'template/dist/assets/qr_codes/' . $qrFilename;
        $qrImage->saveToFile($qrPath);

        $data = [
            'nama' => $nama,
            'no_anggota' => $newNoAnggota,
            'jenis_kelamin' => $jenis_kelamin,
            'kelas' => $kelas,
            'no_hp' => $no_hp,
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
        $jenis_kelamin = $this->request->getPost('jenis_kelamin');
        $no_hp = $this->request->getPost('no_hp');
        $kelas = $this->request->getPost('kelas');

        // Buat isi QR code
        $qrContent = "Nama: $nama\nNo Anggota: $no_anggota\nJenis Kelamin: $jenis_kelamin\nNo. HP: $no_hp\nKelas: $kelas";

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
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kelas' => $this->request->getPost('kelas'),
            'no_hp' => $this->request->getPost('no_hp'),
            'kode_qr' => $qrFilename,
        ];

        $this->AnggotaModel->updateAnggota($id_anggota, $data);

        session()->setFlashdata('success', 'Data Anggota Berhasil Diedit');
        return redirect()->to('/home/anggota');
    }

    // public function hapus_anggota($id_anggota)
    // {
    //     $this->AnggotaModel->deleteAnggota($id_anggota);

    //     session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus');
    //     return redirect()->to('/home/anggota');
    // }

    public function hapus_anggota($id_anggota)
    {
        // Hapus semua data peminjaman terkait anggota
        $this->AnggotaModel->hapusPeminjamanByAnggota($id_anggota);

        // Lalu hapus data anggota
        $this->AnggotaModel->deleteAnggota($id_anggota);

        session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus');
        return redirect()->to('/home/anggota');
    }


    // Fungsi untuk naikkan kelas semua anggota
    public function naikKelas()
    {
        $this->AnggotaModel->updateKelasAnggota();

        session()->setFlashdata('success', 'Kelas anggota berhasil dinaikkan dan QR Code diperbarui. Data kelas 10 ke atas sudah dihapus.');
        return redirect()->to(base_url('home/anggota'));
    }




    public function cetak_kartu($id)
    {
        $anggota = $this->AnggotaModel->getById($id);

        // Pastikan jadi object
        if (is_array($anggota)) {
            $anggota = (object) $anggota;
        }

        // Load view kartu
        $html = view('kartu_template', ['anggota' => $anggota]);

        // Konfigurasi ukuran kartu (8.6cm x 5.4cm)
        $mpdf = new Mpdf([
            'format' => [86, 54],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0
        ]);

        $mpdf->WriteHTML($html);

        // Output ke browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output("Kartu_{$anggota->nama}.pdf", 'I'));
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
        $katalogFilter = $this->request->getGet('katalog');
        $rakFilter = $this->request->getGet('rak');

        $buku = $this->BukuModel->getFilteredBuku($katalogFilter, $rakFilter);

        $data = [
            'title' => 'Data Buku',
            'buku' => $buku,
            'katalog' => $this->BukuModel->getKatalog(),
            'rak' => $this->BukuModel->getRak(),
            'katalogFilter' => $katalogFilter,  // Kirim nilai filter ke view
            'rakFilter' => $rakFilter,          // Kirim nilai filter ke view
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
            'rak' => $this->request->getPost('rak'),
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

        if ($fileSampul && $fileSampul->isValid() && !$fileSampul->hasMoved()) {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('template/dist/assets/covers', $namaFile);
            $sampul = $namaFile;
        } else {
            // Tidak ada file baru diupload, jadi jangan ubah sampul
            $sampul = null;
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'kota' => $this->request->getPost('kota'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jilid' => $this->request->getPost('jilid'),
            'jumlah_buku' => $this->request->getPost('jumlah_buku'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'katalog' => $this->request->getPost('katalog'),
            'rak' => $this->request->getPost('rak'),
            'jumlah_halaman' => $this->request->getPost('jumlah_halaman'),
            'isbn' => $this->request->getPost('isbn'),
        ];

        // Hanya update 'sampul' jika ada file baru
        if ($sampul !== null) {
            $data['sampul'] = $sampul;
        }

        $this->BukuModel->updateBuku($id_buku, $data);
        session()->setFlashdata('success', 'Data Buku Berhasil Diedit');
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
            'anggota' => $this->AnggotaModel->getAll(),
            'buku' => $this->BukuModel->getBuku(),
            'isi' => 'v_peminjaman',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_peminjaman()
    {
        $id_anggota = $this->request->getPost('id_anggota');
        $judul = $this->request->getPost('judul');
        $jumlah = (int) $this->request->getPost('jumlah_buku');

        $anggota = $this->AnggotaModel->getById($id_anggota);
        if (!$anggota) {
            session()->setFlashdata('gagal', 'Anggota tidak ditemukan');
            return redirect()->back()->withInput();
        }

        $id_anggota = $anggota['id_anggota'];

        // ✅ Cek apakah anggota masih punya pinjaman aktif
        if ($this->PeminjamanModel->hasUnfinishedLoan($id_anggota)) {
            session()->setFlashdata('gagal', 'Anggota masih memiliki peminjaman yang belum dikembalikan.');
            return redirect()->back()->withInput();
        }

        // Ambil buku berdasarkan ISBN atau judul (disesuaikan logikamu)
        $buku = $this->BukuModel->getBukuByIsbn($judul);
        if (!$buku) {
            session()->setFlashdata('gagal', 'Buku tidak ditemukan');
            return redirect()->back()->withInput();
        }

        if ($buku['jumlah_buku'] < $jumlah) {
            session()->setFlashdata('gagal', 'Stok buku tidak mencukupi');
            return redirect()->back()->withInput();
        }

        $id_buku = $buku['id_buku'];

        $data = [
            'id_anggota' => $id_anggota,
            'id_buku' => $id_buku,
            'jumlah_buku' => $jumlah,
            'tgl_peminjaman' => $this->request->getPost('tgl_peminjaman'),
            'batas_waktu' => $this->request->getPost('batas_waktu'),
        ];

        if (!$this->PeminjamanModel->insertPeminjaman($data)) {
            session()->setFlashdata('gagal', 'Gagal menambahkan peminjaman');
            return redirect()->back()->withInput();
        }

        // Update stok buku
        $stok_baru = $buku['jumlah_buku'] - $jumlah;
        $this->BukuModel->updateBuku($id_buku, ['jumlah_buku' => $stok_baru]);

        session()->setFlashdata('success', 'Data Peminjaman Berhasil Ditambahkan');
        return redirect()->to('/home/peminjaman');
    }

    public function edit_peminjaman($id_peminjaman)
    {
        // Ambil data peminjaman lama
        $peminjaman_lama = $this->PeminjamanModel->getPeminjamanById($id_peminjaman);
        if (!$peminjaman_lama) {
            session()->setFlashdata('gagal', 'Data peminjaman tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        $nama = $this->request->getPost('nama');
        $judul = $this->request->getPost('judul');
        $jumlah_baru = (int) $this->request->getPost('jumlah_buku');

        $anggota = $this->AnggotaModel->getAnggotaByNama($nama);
        if (!$anggota) {
            session()->setFlashdata('gagal', 'Anggota tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        $buku = $this->BukuModel->getBukuByIsbn($judul);
        if (!$buku) {
            session()->setFlashdata('gagal', 'Buku tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        $stok_setelah_pengembalian = $buku['jumlah_buku'] + $peminjaman_lama['jumlah_buku'];
        if ($stok_setelah_pengembalian < $jumlah_baru) {
            session()->setFlashdata('gagal', 'Stok buku tidak mencukupi.');
            return redirect()->to('/home/peminjaman');
        }

        $data = [
            'id_anggota' => $anggota['id_anggota'],
            'id_buku' => $buku['id_buku'],
            'jumlah_buku' => $jumlah_baru,
            'tgl_peminjaman' => $this->request->getPost('tgl_peminjaman'),
            'batas_waktu' => $this->request->getPost('batas_waktu'),
        ];

        // Debug data
        // var_dump($data); die();

        // Hanya filter null, biarkan string kosong tetap ada
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        if (empty($data)) {
            session()->setFlashdata('gagal', 'Tidak ada data untuk diupdate.');
            return redirect()->back()->withInput();
        }

        $this->PeminjamanModel->updatePeminjaman($id_peminjaman, $data);

        $stok_akhir = $stok_setelah_pengembalian - $jumlah_baru;
        $this->BukuModel->updateBuku($buku['id_buku'], ['jumlah_buku' => $stok_akhir]);

        session()->setFlashdata('success', 'Data Peminjaman Berhasil Diedit');
        return redirect()->to('/home/peminjaman');
    }

    public function selesai_peminjaman($id)
    {
        $pengembalianModel = new \App\Models\PengembalianModel();
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $bukuModel = new \App\Models\BukuModel();
        $dendaModel = new \App\Models\DendaModel();

        // Ambil data dari form
        $status = $this->request->getPost('status');
        $jenis_ganti = $this->request->getPost('jenis_ganti');
        $nilai_ganti = $this->request->getPost('nilai_ganti');
        $id_buku = $this->request->getPost('id_buku');
        $jumlah_buku = $this->request->getPost('jumlah_buku');

        // Validasi input dasar
        if (!$status) {
            session()->setFlashdata('gagal', 'Status pengembalian wajib diisi.');
            return redirect()->back()->withInput();
        }

        if (in_array($status, ['rusak', 'hilang'])) {
            if (!$jenis_ganti) {
                session()->setFlashdata('gagal', 'Jenis penggantian wajib dipilih.');
                return redirect()->back()->withInput();
            }

            if ($jenis_ganti === 'nilai_ganti') {
                if (!is_numeric($nilai_ganti) || $nilai_ganti <= 0) {
                    session()->setFlashdata('gagal', 'Nilai penggantian tidak valid.');
                    return redirect()->back()->withInput();
                }
            }

            if ($jenis_ganti === 'buku') {
                if (empty(trim($nilai_ganti))) {
                    session()->setFlashdata('gagal', 'Detail buku pengganti wajib diisi.');
                    return redirect()->back()->withInput();
                }
            }
        } else {
            // Jika bukan rusak/hilang, kosongkan nilai ganti
            $jenis_ganti = null;
            $nilai_ganti = null;
        }

        // Simpan data ke tabel pengembalian
        $pengembalianModel->insert([
            'id_peminjaman' => $id,
            'status' => $status,
            'jenis_ganti' => $jenis_ganti,
            'nilai_ganti' => $nilai_ganti,
            'tanggal_pengembalian' => date('Y-m-d H:i:s')
        ]);

        $id_pengembalian = $pengembalianModel->getInsertID();

        // Logika denda
        $jumlah_denda = 0;
        $denda_per_hari = 3000; // Denda per hari keterlambatan

        if ($status == 'terlambat') {
            // Ambil data peminjaman utk cek batas waktu
            $peminjaman = $peminjamanModel->find($id);
            if ($peminjaman) {
                $batas_waktu = $peminjaman['batas_waktu']; // format yyyy-mm-dd
                $tanggal_pengembalian = date('Y-m-d');

                $datetime1 = new \DateTime($batas_waktu);
                $datetime2 = new \DateTime($tanggal_pengembalian);


                $interval = $datetime1->diff($datetime2);
                $hari_terlambat = (int) $interval->format('%r%a'); // Selisih hari, bisa negatif jika belum terlambat

                if ($hari_terlambat > 0) {
                    $jumlah_denda = $hari_terlambat * $denda_per_hari;
                }
            }
        } elseif (in_array($status, ['rusak', 'hilang'])) {
            $jumlah_denda = $nilai_ganti ?? 0;
        }

        if ($jumlah_denda > 0) {
            $dendaModel->insert([
                'id_pengembalian' => $id_pengembalian,
                'jumlah_denda' => $jumlah_denda,
                'status_denda' => 'belum lunas',
                'tanggal_pembayaran' => null,
                'keterangan' => 'Denda karena ' . $status,
            ]);
        }

        // Tambahkan stok buku kembali jika status bukan hilang
        if (in_array($status, ['tepat waktu', 'terlambat', 'rusak'])) {
            if (!empty($id_buku) && $jumlah_buku > 0) {
                $buku = $bukuModel->find($id_buku);
                if ($buku) {
                    $stok_sekarang = isset($buku['jumlah_buku']) ? (int) $buku['jumlah_buku'] : 0;
                    $bukuModel->update($id_buku, [
                        'jumlah_buku' => $stok_sekarang + $jumlah_buku
                    ]);
                } else {
                    log_message('error', 'Data buku dengan id ' . $id_buku . ' tidak ditemukan.');
                }
            }
        }

        session()->setFlashdata('success', 'Peminjaman berhasil diselesaikan.');
        return redirect()->to('/home/pengembalian');
    }



    // Pengembalian methods
    // These methods handle the operations related to pengembalian (returns) such as viewing, adding, editing, and deleting returns.
    public function pengembalian()
    {
        $data = [
            'title' => 'Data Pengembalian',
            'pengembalian' => $this->PengembalianModel->getAllPengembalian(),
            'isi' => 'v_pengembalian',
        ];
        return view('layout/v_wrapper', $data);
    }

    // Denda methods
    // These methods handle the operations related to denda (fines) such as viewing, adding, editing, and deleting fines.
    public function denda()
    {
        $dendaModel = new \App\Models\DendaModel();

        // Ambil data denda lengkap dengan join data anggota, peminjaman, pengembalian
        $denda = $dendaModel->getDendaWithAnggota();

        $data = [
            'title' => 'Data Denda',
            'denda' => $denda,
            'isi' => 'v_denda',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function updateStatus($id_denda)
    {
        $statusBaru = $this->request->getPost('status_denda');

        if (!in_array($statusBaru, ['belum lunas', 'lunas'])) {
            session()->setFlashdata('error', 'Status denda tidak valid.');
            return redirect()->back();
        }

        $dataUpdate = [
            'status_denda' => $statusBaru,
        ];

        if ($statusBaru === 'lunas') {
            $dataUpdate['tanggal_pembayaran'] = date('Y-m-d'); // isi tanggal hari ini
        } else {
            $dataUpdate['tanggal_pembayaran'] = null; // kosongkan tanggal pelunasan
        }

        $dendaModel = new \App\Models\DendaModel();
        $dendaModel->update($id_denda, $dataUpdate);

        session()->setFlashdata('success', 'Status denda berhasil diperbarui.');
        return redirect()->to('/home/denda');
    }

    // Fungsi untuk mengirim pengingat peminjaman via WhatsApp
    public function kirimPengingatPeminjaman($id_peminjaman)
    {
        $peminjaman = $this->PeminjamanModel->getPeminjamanById($id_peminjaman);

        if (!$peminjaman) {
            session()->setFlashdata('gagal', 'Data peminjaman tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        // Cek apakah peminjaman sudah dikembalikan
        $pengembalian = $this->PengembalianModel
            ->where('id_peminjaman', $id_peminjaman)
            ->first();

        if ($pengembalian) {
            session()->setFlashdata('gagal', 'Peminjaman sudah dikembalikan, tidak perlu mengirim pengingat.');
            return redirect()->to('/home/peminjaman');
        }

        $anggota = $this->AnggotaModel->find($peminjaman['id_anggota']);

        if (!$anggota || empty($anggota['no_hp'])) {
            session()->setFlashdata('gagal', 'Nomor HP anggota tidak ditemukan.');
            return redirect()->to('/home/peminjaman');
        }

        // Format nomor WA menggunakan fungsi yang sudah ada
        $no_wa = $this->formatNomorHp($anggota['no_hp']);

        // Tambahkan tanda "+" di depan jika belum ada
        if (substr($no_wa, 0, 1) !== '+') {
            $no_wa = '+' . $no_wa;
        }

        // Validasi nomor WA
        if (!preg_match('/^\+628[1-9][0-9]{7,10}$/', $no_wa)) {
            session()->setFlashdata('gagal', 'Format nomor WhatsApp tidak valid: ' . $no_wa);
            return redirect()->to('/home/peminjaman');
        }

        // Cek apakah sudah lewat batas waktu
        $today = date('Y-m-d');
        $batasWaktu = $peminjaman['batas_waktu'];
        $telat = strtotime($today) > strtotime($batasWaktu);

        // Buat pesan pengingat
        $message = "Halo " . $anggota['nama'] . ",\n"
            . "Ini adalah pengingat untuk mengembalikan buku berjudul:\n"
            . "📚 *" . $peminjaman['judul_buku'] . "*\n"
            . "Jumlah: " . $peminjaman['jumlah_buku'] . "\n"
            . "Batas waktu: " . date('d-m-Y', strtotime($batasWaktu)) . "\n\n";

        if ($telat) {
            $message .= "⚠️ *Anda sudah melewati batas waktu pengembalian.*\n"
                . "Anda berpotensi dikenakan *denda*.\n"
                . "Mohon segera kembalikan buku ke perpustakaan.\n"
                . "Abaikan pesan ini jika sudah mengembalikan buku.\n";
        } else {
            $message .= "Mohon segera dikembalikan ke perpustakaan sebelum tanggal tersebut.\n";
        }

        $message .= "\nTerima kasih 🙏";

        // Kirim melalui API Sidobe
        $apiUrl = 'https://api.sidobe.com/wa/v1/send-message';
        $secretKey = 'ymDubThkMTLFOiQIoUXrqxOIzlNYAaNsPQwpBPZcokStGVPpuy'; // Ganti jika perlu

        $payload = json_encode([
            'phone' => $no_wa,
            'message' => $message
        ]);

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "X-Secret-Key: $secretKey"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            session()->setFlashdata('success', 'Pesan pengingat berhasil dikirim ke ' . $anggota['nama']);
        } else {
            session()->setFlashdata('gagal', 'Gagal mengirim pesan. Coba lagi nanti.');
        }

        return redirect()->to('/home/peminjaman');
    }

    private function formatNomorHp($nomorHp)
    {
        // Hapus spasi dan karakter selain angka
        $nomorHp = preg_replace('/[^0-9]/', '', $nomorHp);

        // Jika nomor mulai dengan 0, ganti dengan 62 (kode Indonesia)
        if (substr($nomorHp, 0, 1) === '0') {
            $nomorHp = '62' . substr($nomorHp, 1);
        }

        return $nomorHp;
    }

    public function pengingatOtomatis()
    {
        $today = date('Y-m-d');

        // Ambil peminjaman yang belum dikembalikan dan batas waktu <= hari ini + 3 hari
        $peminjamanMendekatiBatas = $this->PeminjamanModel->getPeminjamanMendekatiBatas(3);

        foreach ($peminjamanMendekatiBatas as $peminjaman) {
            $id_peminjaman = $peminjaman['id_peminjaman'];

            // Cek apakah sudah dikembalikan, skip jika sudah
            $pengembalian = $this->PengembalianModel->where('id_peminjaman', $id_peminjaman)->first();
            if ($pengembalian) {
                continue; // sudah dikembalikan, lewati
            }

            $anggota = $this->AnggotaModel->find($peminjaman['id_anggota']);
            if (!$anggota || empty($anggota['no_hp'])) {
                continue; // nomor hp tidak ada, skip
            }

            // Format nomor
            $no_wa = $this->formatNomorHp($anggota['no_hp']);
            if (substr($no_wa, 0, 1) !== '+') {
                $no_wa = '+' . $no_wa;
            }

            // Validasi nomor WA
            if (!preg_match('/^\+628[1-9][0-9]{7,10}$/', $no_wa)) {
                continue; // nomor tidak valid, skip
            }

            $batasWaktu = $peminjaman['batas_waktu'];
            $telat = strtotime($today) > strtotime($batasWaktu);

            $message = "Halo " . $anggota['nama'] . ",\n"
                . "Ini adalah pengingat untuk mengembalikan buku berjudul:\n"
                . "📚 *" . $peminjaman['judul_buku'] . "*\n"
                . "Jumlah: " . $peminjaman['jumlah_buku'] . "\n"
                . "Batas waktu: " . date('d-m-Y', strtotime($batasWaktu)) . "\n\n";

            if ($telat) {
                $message .= "⚠️ *Anda sudah melewati batas waktu pengembalian.*\n"
                    . "Anda berpotensi dikenakan *denda*.\n"
                    . "Mohon segera kembalikan buku ke perpustakaan.\n"
                    . "Abaikan pesan ini jika sudah mengembalikan buku.\n";
            } else {
                $message .= "Mohon segera dikembalikan ke perpustakaan sebelum tanggal tersebut.\n";
            }

            $message .= "\nTerima kasih 🙏";

            // Kirim pesan lewat API
            $apiUrl = 'https://api.sidobe.com/wa/v1/send-message';
            $secretKey = 'ymDubThkMTLFOiQIoUXrqxOIzlNYAaNsPQwpBPZcokStGVPpuy';

            $payload = json_encode([
                'phone' => $no_wa,
                'message' => $message
            ]);

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                "X-Secret-Key: $secretKey"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                // Bisa log kalau mau
                // log_message('info', "Pesan pengingat otomatis berhasil dikirim ke " . $anggota['nama']);
            } else {
                // Bisa log error kalau mau
                // log_message('error', "Gagal kirim pesan pengingat otomatis ke " . $anggota['nama']);
            }
        }
    }


    // Pengunjung methods
    public function pengunjung()
    {
        $data = [
            'title' => 'Data Pengunjung',
            'pengunjung' => $this->PengunjungModel->getPengunjung(),
            'anggota' => $this->AnggotaModel->getAnggota(),
            'kunjungan' => $this->PengunjungModel->getPengunjung(), // tambahkan ini, sesuaikan dengan data yang ingin ditampilkan
            'isi' => 'v_pengunjung',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah_kunjungan()
    {
        $tanggal_kunjungan = $this->request->getPost('tanggal_kunjungan');
        $id_anggota = $this->request->getPost('id_anggota');

        if (empty($tanggal_kunjungan) || empty($id_anggota)) {
            session()->setFlashdata('error', 'Tanggal kunjungan dan Nama Pengunjung wajib diisi.');
            return redirect()->to('/home/pengunjung')->withInput();
        }

        $data = [
            'tanggal_kunjungan' => $tanggal_kunjungan,
            'id_anggota' => $id_anggota,
        ];

        $this->PengunjungModel->insertPengunjung($data);

        session()->setFlashdata('success', 'Data kunjungan berhasil ditambahkan.');
        return redirect()->to('/home/pengunjung');
    }

    public function update_kunjungan($id_pengunjung)
    {
        $tanggal_kunjungan = $this->request->getPost('tanggal_kunjungan');
        $id_anggota = $this->request->getPost('id_anggota');

        if (empty($tanggal_kunjungan) || empty($id_anggota)) {
            session()->setFlashdata('error', 'Semua field wajib diisi.');
            return redirect()->to('/home/pengunjung')->withInput();
        }

        $data = [
            'tanggal_kunjungan' => $tanggal_kunjungan,
            'id_anggota' => $id_anggota
        ];

        $this->PengunjungModel->updatePengunjung($id_pengunjung, $data);

        session()->setFlashdata('success', 'Data kunjungan berhasil diupdate.');
        return redirect()->to('/home/pengunjung');
    }


    public function edit_kunjungan($id_pengunjung)
    {
        $tanggal_kunjungan = $this->request->getPost('tanggal_kunjungan');
        $id_anggota = $this->request->getPost('id_anggota');

        if (empty($tanggal_kunjungan) || empty($id_anggota)) {
            session()->setFlashdata('error', 'Tanggal dan Nama Pengunjung wajib diisi.');
            return redirect()->to('/home/pengunjung')->withInput();
        }

        $data = [
            'tanggal_kunjungan' => $tanggal_kunjungan,
            'id_anggota' => $id_anggota
        ];

        $this->PengunjungModel->updatePengunjung($id_pengunjung, $data);

        session()->setFlashdata('success', 'Data kunjungan berhasil diedit.');
        return redirect()->to('/home/pengunjung');
    }

    public function hapus_kunjungan($id_pengunjung)
    {
        $this->PengunjungModel->deletePengunjung($id_pengunjung);

        session()->setFlashdata('success', 'Data kunjungan berhasil dihapus.');
        return redirect()->to('/home/pengunjung');
    }


}


