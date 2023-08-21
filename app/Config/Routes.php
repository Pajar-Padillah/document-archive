<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('/logout', 'AuthController::logout');

$routes->get('/home', 'HomeController::index');
$routes->get('/profil', 'ProfilController::index');
$routes->put('/profil/update/(:num)', 'ProfilController::update/$1');
$routes->put('/profil/change_password/(:num)', 'ProfilController::change_password/$1');

$routes->get('/user', 'UserController::index');
$routes->get('/user/create', 'UserController::create');
$routes->post('/user/save', 'UserController::save');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->put('/user/update/(:num)', 'UserController::update/$1');
$routes->delete('/user/(:num)', 'UserController::delete/$1');

$routes->get('/lumpsum', 'LumpsumController::index');
$routes->post('/lumpsum/search', 'LumpsumController::index');
$routes->get('/lumpsum/create', 'LumpsumController::create');
$routes->post('/lumpsum/save', 'LumpsumController::save');
$routes->get('/lumpsum/edit/(:num)', 'LumpsumController::edit/$1');
$routes->put('/lumpsum/update/(:num)', 'LumpsumController::update/$1');
$routes->delete('/lumpsum/(:num)', 'LumpsumController::delete/$1');

$routes->get('/gup', 'GUPController::index');
$routes->post('/gup/search', 'GUPController::index');
$routes->get('/gup/create', 'GUPController::create');
$routes->post('/gup/save', 'GUPController::save');
$routes->get('/gup/edit/(:num)', 'GUPController::edit/$1');
$routes->put('/gup/update/(:num)', 'GUPController::update/$1');
$routes->delete('/gup/(:num)', 'GUPController::delete/$1');



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
