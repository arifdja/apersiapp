<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::login');
$routes->get('/login', 'User::login');
$routes->get('/register', 'User::register');
$routes->post('/validateuser', 'User::validateUser');
$routes->get('/hashpassword/(:any)', 'User::hashpassword/$1');
$routes->get('/logout', 'User::logout');
$routes->get('/profil', 'User::profil');
$routes->get('/form_register', 'User::form_register');
$routes->post('/register', 'User::register');
$routes->post('/register_ajax', 'User::register_ajax');
$routes->post('/get_kabupaten', 'User::get_kabupaten');
$routes->post('/get_kota', 'User::get_kota');
$routes->post('/get_kecamatan', 'User::get_kecamatan');


$routes->get('/developer', 'Developer::index',['filter' => 'auth']);
$routes->get('/developer/form_pengajuan', 'Developer::form_pengajuan',['filter' => 'auth']);
$routes->get('/developer/dashboard', 'Developer::dashboard',['filter' => 'auth']);
$routes->get('/profil', 'User::profil',['filter' => 'auth']);

$routes->get('/operator', 'Operator::index',['filter' => 'auth']);
$routes->get('/operator/approval_developer', 'Operator::approvalDeveloper',['filter' => 'auth']);
$routes->get('/downloadkta/(:any)', 'FileController::downloadkta/$1',['filter' => 'auth']);
$routes->post('/operator/do_approve_developer', 'Operator::do_approve_developer');
$routes->post('/operator/dont_approve_developer', 'Operator::dont_approve_developer');

$routes->get('/developer/form_pengajuan_pt', 'Developer::form_pengajuan_pt',['filter' => 'auth']);
$routes->get('/developer/form_pengajuan_dana', 'Developer::form_pengajuan_dana',['filter' => 'auth']);

$routes->get('/rumput', 'Rumput::index',['filter' => 'auth']);

$routes->get('/unauthorized', 'Unauthorized::index');
