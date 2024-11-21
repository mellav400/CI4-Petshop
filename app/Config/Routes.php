<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Produk Routes
$routes->get('/produk', 'Produk::index');                      // Menampilkan halaman utama produk
$routes->get('/produk/tampil', 'Produk::tampil_produk');        // Menampilkan data produk
$routes->get('/produk/edit/(:num)', 'Produk::edit_produk/$1');  // Menampilkan data produk berdasarkan ID untuk diedit
$routes->post('/produk/update', 'Produk::update_produk');       // Mengupdate data produk
$routes->post('/produk/simpan', 'Produk::simpan_produk');       // Menyimpan produk baru
$routes->delete('/produk/delete/(:num)', 'Produk::hapus_data/$1'); // Menghapus produk berdasarkan ID

// Pelanggan Routes
$routes->get('/pelanggan', 'Pelanggan::index');                      // Menampilkan halaman utama pelanggan
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');     // Menampilkan data pelanggan
$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');    // Menyimpan pelanggan baru
$routes->get('/pelanggan/edit_pelanggan/(:num)', 'Pelanggan::edit_pelanggan/$1'); // Mengedit data pelanggan berdasarkan ID
$routes->post('/pelanggan/update/(:num)', 'Pelanggan::update_pelanggan/$1'); // Mengupdate data pelanggan
$routes->delete('/pelanggan/delete/(:num)', 'Pelanggan::hapus_data/$1'); // Menghapus pelanggan berdasarkan ID
