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
$routes->post('/search-users', 'Home::searchUser');
$routes->get('/search-users', 'Home::searchUser');
$routes->post('/addNewUser', 'Home::AddUser');
$routes->post('/users/restrict/(:num)', 'Home::restrict/$1');
$routes->post('/users/edit/(:num)', 'Home::edit/$1');
$routes->post('/users/unrestrict/(:num)', 'Home::unrestrictUser/$1');
$routes->get('/restricted/user', 'Home::restrictedUser');
$routes->set404Override('App\Controllers\Home::notFound');
/**
 * midterm exam
 */
// Apply the filter to the /admin group
/*$routes->group('admin', ['filter' => 'roleauth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');  // Example route
    // Add more /admin/* routes as needed
});

$routes->group('teacher', ['filter' => 'roleauth:teacher'], function($routes) {
    $routes->get('dashboard', 'Teacher::Dashboard');   // Example route
    // Add more /teacher/* routes as needed
});

$routes->get('announcements', 'Announcement::index');  // Anyone can access this
*/

$routes->setAutoRoute(true);
