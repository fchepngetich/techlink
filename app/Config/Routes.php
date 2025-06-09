<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', to: 'Home::index');
$routes->get('/', 'Home::index', ['filter' => 'authstudent']);

$routes->group('',['filter' => 'cors'], function($routes) {
    // $routes->post('auth/student/register', 'StudentController::register');
    $routes->get('auth/login', 'AuthController::login');
    $routes->post('auth/login/submit', 'AuthController::loginSubmit');
    $routes->get('auth/logout', 'AuthController::logout');

    $routes->get('auth/register', 'AuthController::showRegisterForm');
    $routes->post('auth/register', 'AuthController::register');

    $routes->get('auth/verify', 'AuthController::showVerificationForm');
    $routes->post('auth/verify', 'AuthController::verifyCode');

    $routes->post('student/update-profile', 'Home::updateProfile');
    $routes->post('student/upload-document', 'Home::uploadDocument');
    $routes->get('student/profile', 'Home::viewProfile');
    $routes->get('student/profile/edit', 'Home::editProfile');
    $routes->post('student/profile/update', 'Home::updateProfile');


    $routes->get('student/opportunities', 'Home::listOpportunities');
    $routes->get('student/opportunity/view/(:segment)', 'Home::viewOpportunity/$1');
    $routes->get('student/opportunity/apply/(:segment)', 'Home::applyToOpportunity/$1');

    $routes->get('student/applications', 'Home::myApplications');

    $routes->get('student/tests', 'Home::listTests');

    $routes->get('student/notifications', 'Home::notifications');


    $routes->get('student/tests/take/(:segment)', 'TestController::takeTest/$1');
    $routes->post('student/tests/submit', 'TestController::submitTest');

});

$routes->group('api/student', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'StudentController::getProfile');
    $routes->put('profile', 'StudentController::updateProfile');
    $routes->get('documents', 'StudentController::getDocuments');
    $routes->post('documents', 'StudentController::uploadDocument');
});

