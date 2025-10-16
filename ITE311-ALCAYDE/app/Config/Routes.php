<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * Lab 3 ni sya dre
 */
$routes->get('/', 'Auth::dashboard');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
/**
 *Lab 4 ni sya dre
 */
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
/**
 * lab 5 ni sya dre
 */
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/user-management', 'Home::userManagement');
$routes->get('/course-management', 'Home::course_management');
$routes->set404Override('App\Controllers\Home::notFound');
/**
 * midterm exam
 */
$routes->get('/announcement', 'Announcement::index');

$routes->setAutoRoute(true);
