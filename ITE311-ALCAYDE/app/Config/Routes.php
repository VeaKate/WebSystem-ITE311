<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * Lab 3 ni sya dre
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
/**
 *Lab 4 ni sya dre
 */
$routes->get('/register', 'Auth::new');
$routes->get('/login', 'Auth::index');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->post('/register', 'Auth::create');
$routes->get('/register/success', 'Auth::success');

$routes->setAutoRoute(true);