<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/services', 'Services::index');
$routes->match(['get', 'post'], '/contact', 'Contact::index');
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');

// Authentication routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->post('/logout', 'Auth::logout');

// Admin routes
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/account/new', 'Admin::newAccount');
$routes->post('/admin/account', 'Admin::createAccount');
$routes->get('/admin/account/(:num)', 'Admin::viewAccount/$1');
$routes->get('/admin/account/(:num)/edit', 'Admin::editAccount/$1');
$routes->post('/admin/account/(:num)', 'Admin::updateAccount/$1');
$routes->post('/admin/account/(:num)/delete', 'Admin::deleteAccount/$1');
