<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::login');
$routes->get('/login', 'User::login');
$routes->get('/register', 'User::register');
$routes->post('/validateuser', 'User::validateUser');
// $routes->get('/hashpassword/(:any)', 'User::hashpassword/$1');
$routes->get('/logout', 'User::logout');
$routes->get('/profil', 'User::profil');
$routes->get('/form_register', 'User::form_register');
// $routes->post('/register', 'User::register');
$routes->post('/register_ajax', 'User::register_ajax');
$routes->post('/get_kabupaten', 'User::get_kabupaten');
$routes->post('/get_kota', 'User::get_kota');
$routes->post('/get_kecamatan', 'User::get_kecamatan');
$routes->get('/profil', 'User::profil',['filter' => 'auth']);


$routes->get('/developer', 'Developer::index',['filter' => 'auth']);
$routes->get('/developer/dashboard', 'Developer::dashboard',['filter' => 'auth']);
$routes->get('/developer/form_pengajuan_pt', 'Developer::form_pengajuan_pt',['filter' => 'auth']);
$routes->get('/developer/form_pengajuan_dana', 'Developer::form_pengajuan_dana',['filter' => 'auth']);
$routes->post('/developer/pengajuan_pt_ajax', 'Developer::pengajuan_pt_ajax',['filter' => 'auth']);
$routes->post('/developer/pengajuan_dana_ajax', 'Developer::pengajuan_dana_ajax',['filter' => 'auth']);
$routes->post('/developer/get_pt', 'Developer::get_pt',['filter' => 'auth']);
$routes->get('/developer/monitoring_pengajuan_dana', 'Developer::monitoring_pengajuan_dana',['filter' => 'auth']);
// $routes->get('/developer/monitoring_detail_pengajuan_dana/(:any)', 'Developer::monitoring_detail_pengajuan_dana/$',['filter' => 'auth']);
$routes->get('/developer/form_tambah_unit', 'Developer::form_tambah_unit',['filter' => 'auth']);
$routes->post('/developer/tambah_unit_ajax', 'Developer::tambah_unit_ajax',['filter' => 'auth']);
$routes->get('/developer/monitoring_detail_pengajuan_dana', 'Developer::monitoring_detail_pengajuan_dana',['filter' => 'auth']);
$routes->get('/developer/monitoring_pengajuan_pt', 'Developer::monitoring_pengajuan_pt',['filter' => 'auth']);
$routes->get('/developer/form_edit_unit', 'Developer::form_edit_unit',['filter' => 'auth']);
$routes->post('/developer/edit_unit_ajax', 'Developer::edit_unit_ajax',['filter' => 'auth']);
$routes->post('/developer/delete_unit_ajax', 'Developer::delete_unit_ajax',['filter' => 'auth']);

$routes->get('/operator', 'Operator::index',['filter' => 'auth']);
$routes->get('/operator/approval_developer', 'Operator::approval_developer',['filter' => 'auth']);
$routes->post('/operator/do_approve_developer', 'Operator::do_approve_developer',['filter' => 'auth']);
$routes->post('/operator/dont_approve_developer', 'Operator::dont_approve_developer',['filter' => 'auth']);
$routes->get('/operator/approval_pt', 'Operator::approval_pt',['filter' => 'auth']);    
$routes->post('/operator/do_approve_pt', 'Operator::do_approve_pt',['filter' => 'auth']);
$routes->post('/operator/dont_approve_pt', 'Operator::dont_approve_pt',['filter' => 'auth']);
$routes->get('/operator/approval_unit', 'Operator::approval_unit',['filter' => 'auth']);
$routes->get('/operator/approval_dana', 'Operator::approval_dana',['filter' => 'auth']);
$routes->post('/operator/do_approve_dana', 'Operator::do_approve_dana',['filter' => 'auth']);
$routes->post('/operator/dont_approve_dana', 'Operator::dont_approve_dana',['filter' => 'auth']);


$routes->post('/operator/do_approve_unit/(:any)/(:any)', 'Operator::do_approve_unit/$1/$2',['filter' => 'auth']);
$routes->post('/operator/do_reject_unit/(:any)/(:any)', 'Operator::do_reject_unit/$1/$2',['filter' => 'auth']);

$routes->get('/operator/dashboard', 'Operator::dashboard',['filter' => 'auth']);




$routes->get('/rumput', 'Rumput::index',['filter' => 'auth']);
$routes->get('/unauthorized', 'Unauthorized::index');

$routes->get('/download/(:any)/(:any)', 'FileController::download/$1/$2',['filter' => 'auth']);

$routes->get('/form_lupa_password', 'User::form_lupa_password');
$routes->post('/get_token_reset_password', 'User::get_token_reset_password');
$routes->get('/form_reset_password/(:any)', 'User::form_reset_password/$1');
$routes->post('/proses_reset_password', 'User::proses_reset_password');
