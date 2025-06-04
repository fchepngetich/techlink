<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api',['filter' => 'cors'], function($routes) {
    $routes->post('student/register', 'StudentController::register');
    $routes->post('student/login', 'StudentController::login');
    
    // Future protected routes
    // $routes->get('student/profile', 'StudentController::profile', ['filter' => 'jwt']);
});

$routes->group('api/student', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'StudentController::getProfile');
    $routes->put('profile', 'StudentController::updateProfile');
    $routes->get('documents', 'StudentController::getDocuments');
    $routes->post('documents', 'StudentController::uploadDocument');
});

