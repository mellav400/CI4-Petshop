<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/tampil', 'Produk::tampil_produk');
$routes->get('/produk/edit/(:num)', 'Produk::edit_produk/$1');
$routes->post('/produk/update', 'Produk::update_produk');
$routes->post('/produk/simpan', 'Produk::simpan_produk');
$routes->delete('/produk/delete/(:num)', 'Produk::hapus_data/$1');