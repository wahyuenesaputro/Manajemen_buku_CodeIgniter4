<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// HOME & DASHBOARD
$routes->get('/', 'Home::index'); 
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/settings', 'settings::index');

// AUTHENTICATION (Login, Logout, Register)
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess'); 
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');       
$routes->post('/register/process', 'Auth::processRegister'); 

// BOOK MANAGEMENT (Data Buku)
$routes->group('book', function($routes) {
$routes->get('/', 'Book::index');               
$routes->post('store', 'Book::store');           
$routes->get('delete/(:num)', 'Book::delete/$1'); 
});