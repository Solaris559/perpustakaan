<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Login routes
$routes->get('/', 'Home::login');
$routes->post('home/cek_login', 'Home::cek_login');

// Logout route
$routes->get('home/logout', 'Home::logout');

// Define routes for the Home controller with authentication filter
$routes->group('home', ['filter' => 'auth'], function ($routes) {
    // Dashboard routes
    $routes->get('index', 'Home::index');

    // Anggota routes
    $routes->get('anggota', 'Home::anggota');
    $routes->post('tambah_anggota', 'Home::tambah_anggota');
    $routes->get('edit_anggota', 'Home::edit_anggota');
    $routes->get('hapus_anggota', 'Home::hapus_anggota');

    // Buku routes
    $routes->get('buku', 'Home::buku');
    $routes->post('tambah_buku', 'Home::tambah_buku');
    $routes->get('edit_buku', 'Home::edit_buku');
    $routes->get('hapus_buku', 'Home::hapus_buku');

    // Peminjaman routes
    $routes->get('peminjaman', 'Home::peminjaman');
    $routes->post('tambah_peminjaman', 'Home::tambah_peminjaman');
    $routes->get('edit_peminjaman', 'Home::edit_peminjaman');
    $routes->get('hapus_peminjaman', 'Home::hapus_peminjaman');

    // Pengembalian routes
    $routes->get('pengembalian', 'Home::pengembalian');
    $routes->get('tambah_pengembalian', 'Home::tambah_pengembalian');
    $routes->get('edit_pengembalian', 'Home::edit_pengembalian');
    $routes->get('hapus_pengembalian', 'Home::hapus_pengembalian');

    // Denda routes
    $routes->get('denda', 'Home::denda');
    $routes->get('tambah_denda', 'Home::tambah_denda');
    $routes->get('edit_denda', 'Home::edit_denda');
    $routes->get('hapus_denda', 'Home::hapus_denda');
});