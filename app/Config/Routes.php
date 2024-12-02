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
$routes->get('/developer', 'Developer::index');
$routes->get('/logout', 'User::logout');
$routes->get('/profil', 'User::profil');
$routes->get('/form_register', 'User::form_register');
$routes->post('/register', 'User::register');