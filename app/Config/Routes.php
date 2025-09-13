<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Login routes
$routes->get('/', 'Home::login');
$routes->post('home/cek_login', 'Home::cek_login');


// $routes->get('home/kirimPengingatPeminjaman', 'Home::kirimPengingatPeminjaman');


// Logout route
$routes->get('home/logout', 'Home::logout');

// Define routes for the Home controller with authentication filter
$routes->group('home', ['filter' => 'auth'], function ($routes) {

    // Notif WA peminjaman
    $routes->get('kirimPengingatPeminjaman/(:num)', 'Home::kirimPengingatPeminjaman/$1');

    // Dashboard routes
    $routes->get('index', 'Home::index');

    // Petugas routes
    $routes->get('edit_petugas/(:num)', 'Home::edit_petugas_form/$1');
    $routes->post('edit_petugas/(:num)', 'Home::edit_petugas/$1');


    // Anggota routes
    $routes->get('anggota', 'Home::anggota');
    $routes->post('tambah_anggota', 'Home::tambah_anggota');
    // $routes->post('edit_anggota', 'Home::edit_anggota');
    $routes->post('edit_anggota/(:num)', 'Home::edit_anggota/$1');
    $routes->post('hapus_anggota/(:num)', 'Home::hapus_anggota/$1');
    $routes->get('naikKelas', 'Home::naikKelas');

    // ✅ Tambahkan routing cetak kartu dengan sintaks CI4
    $routes->get('cetak_kartu/(:num)', 'Home::cetak_kartu/$1');
    $routes->get('cetak_semua_kartu', 'Home::cetak_semua_kartu');

    // Buku routes
    $routes->get('buku', 'Home::buku');
    $routes->post('tambah_buku', 'Home::tambah_buku');
    // $routes->post('edit_buku', 'Home::edit_buku');
    $routes->post('edit_buku/(:num)', 'Home::edit_buku/$1');
    $routes->post('hapus_buku/(:num)', 'Home::hapus_buku/$1');

    // Peminjaman routes
    $routes->get('peminjaman', 'Home::peminjaman');
    $routes->post('tambah_peminjaman', 'Home::tambah_peminjaman');
    $routes->post('edit_peminjaman/(:num)', 'Home::edit_peminjaman/$1');
    $routes->post('selesai_peminjaman/(:num)', 'Home::selesai_peminjaman/$1');


    // Pengembalian routes
    $routes->get('pengembalian', 'Home::pengembalian');
    $routes->post('tambah_pengembalian', 'Home::tambah_pengembalian');
    $routes->post('edit_pengembalian', 'Home::edit_pengembalian');
    $routes->post('hapus_pengembalian', 'Home::hapus_pengembalian');

    // Denda routes
    $routes->get('denda', 'Home::denda');
    $routes->post('tambah_denda', 'Home::tambah_denda');
    $routes->post('edit_denda', 'Home::edit_denda');
    $routes->post('hapus_denda', 'Home::hapus_denda');

    // Denda routes
    $routes->post('updateStatus/(:num)', 'Home::updateStatus/$1');

    // Pengunjung routes
    $routes->get('pengunjung', 'Home::pengunjung');
    $routes->post('tambah_kunjungan', 'Home::tambah_kunjungan');
    $routes->post('edit_kunjungan/(:num)', 'Home::edit_kunjungan/$1');
    $routes->post('hapus_kunjungan/(:num)', 'Home::hapus_kunjungan/$1');



});