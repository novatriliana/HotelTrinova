<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::home_tamu');
$routes->get('/Kamar', 'Home::kamar');
$routes->get('/hotel', 'Home::hotel');
$routes->get('/Reservasi', 'Home::reservasi');
$routes->post('/Reservasi/simpan', 'Home::simpanreservasi');
$routes->get('/login', 'PetugasController::index');
$routes->post('/login', 'PetugasController::login');
$routes->get('/logout', 'PetugasController::logout');
$routes->get('/petugas/dashboard', 'DashboardPetugas::index',['filter'=>'otentifikasi']);
$routes->get('/resepsionis/dashboard', 'DashboardPetugas::index',['filter'=>'otentifikasi']);
$routes->get('/reservasi/print', 'Home::print');

// Untuk memesan kamar
$routes->get('/pemesanan', 'FormPemesanan::index');
$routes->get('/simpan-pemesanan', 'FormPemesanan::simpan');
$routes->get('/inv/(:num)', 'Home::invoice/$1');

//route CRUD Kamar
$routes->get('/kamar', 'PetugasController::tampilkamar');
$routes->get('/kamar/tambah', 'PetugasController::tambahkamar');
$routes->post('/kamar/simpan', 'PetugasController::simpankamar');
$routes->get('/kamar/edit/(:num)', 'PetugasController::editkamar/$1');
$routes->post('/kamar/update', 'PetugasController::updatekamar');
$routes->get('/kamar/edit-foto/(:num)', 'PetugasController::editfoto/$1');
$routes->post('/kamar/updatefoto', 'PetugasController::updatefoto');
$routes->get('/kamar/hapus/(:num)', 'PetugasController::hapuskamar/$1');

// route CRUD fasilitas kamar
$routes->get('/fasilitas-kamar', 'FasilitasKamarController::tampil');
$routes->get('/fasilitas-kamar/tambah', 'FasilitasKamarController::tambahFasilitas');
$routes->post('/fasilitas-kamar/simpan', 'FasilitasKamarController::simpanFasilitas');
$routes->post('/fasilitas-kamar/update', 'FasilitasKamarController::updatefasilitaskamar');
$routes->get('/Fasilitas-kamar/edit-foto/(:num)', 'FasilitasKamarController::editfoto/$1');
$routes->get('/fasilitas-kamar/edit/(:num)', 'FasilitasKamarController::editFasilitaskamar/$1');
$routes->get('/fasilitas-kamar/hapus/(:num)', 'FasilitasKamarController::hapusfasilitaskamar/$1');

// route CRUD fasilitas hotel
$routes->get('/fasilitas_hotel', 'FasilitasHotelController::tampil');
$routes->get('/fasilitas_hotel/tambah', 'FasilitasHotelController::tambahFasilitashotel');
$routes->post('/fasilitas_hotel/simpan', 'FasilitasHotelController::simpanFasilitasHotel');
$routes->post('/fasilitas_hotel/update', 'FasilitasHotelController::updateFasilitashotel');
$routes->get('/fasilitas_hotel/edit-foto/(:num)', 'FasilitasHotelController::editfoto/$1');
$routes->post('/fasilitas_hotel/updatefoto', 'FasilitasHotelController::updatefoto');
$routes->get('/fasilitas_hotel/edit/(:num)', 'FasilitasHotelController::editFasilitashotel/$1');
$routes->get('/fasilitas_hotel/hapus/(:num)', 'FasilitasHotelController::hapusfasilitashotel/$1');

// route Reservasi Petugas
$routes->get('/reservasi', 'ReservasiController::index',['filter'=>'otentifikasi']);
$routes->post('/reservasi', 'ReservasiController::index',['filter'=>'otentifikasi']);
$routes->get('/reservasi/edit/(:num)', 'ReservasiController::edit/$1',['filter'=>'otentifikasi']);
$routes->get('/reservasi/in/(:num)', 'ReservasiController::in/$1',['filter'=>'otentifikasi']);
$routes->get('/reservasi/out/(:num)', 'ReservasiController::out/$1',['filter'=>'otentifikasi']);
$routes->post('/reservasi/out', 'ReservasiController::out',['filter'=>'otentifikasi']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
