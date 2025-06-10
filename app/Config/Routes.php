<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', to: 'Home::index');
$routes->get('/', 'Home::index', ['filter' => 'authstudent']);

$routes->group('', function($routes) {
    // $routes->post('auth/student/register', 'StudentController::register');
    $routes->get('auth/login', 'AuthController::login');
    $routes->post('auth/login/submit', 'AuthController::loginSubmit');
    $routes->get('auth/logout', 'AuthController::logout');

    $routes->get('auth/register', 'AuthController::showRegisterForm');
    $routes->post('auth/register', 'AuthController::register');

    $routes->get('auth/verify', 'AuthController::showVerificationForm');
    $routes->post('auth/verify', 'AuthController::verifyCode');
    $routes->get('auth/verify-email', 'AuthController::verifyEmail');
    $routes->get('resend-verification', 'AuthController::resendVerification');

    $routes->get('auth/resend-code', 'AuthController::resendCode');
    $routes->post('auth/verify-code', 'AuthController::verifyCode');




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

$routes->group('company', ['filter' => 'authcompany'], function($routes) {
    $routes->get('/', 'CompanyController::index');
    $routes->get('post-opportunity', 'CompanyController::postOpportunityForm');
    $routes->post('post-opportunity', 'CompanyController::submitOpportunity');
    $routes->get('applications', 'CompanyController::viewApplications');
    $routes->get('tests', 'CompanyController::viewTests');
    $routes->get('messages', 'CompanyController::messages');
    $routes->get('opportunity/edit/(:any)', 'CompanyController::editOpportunity/$1');
    $routes->post('opportunity/update/(:any)', 'CompanyController::updateOpportunity/$1');
    $routes->get('opportunities', 'CompanyController::listOpportunities');


});

$routes->group('api/student', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'StudentController::getProfile');
    $routes->put('profile', 'StudentController::updateProfile');
    $routes->get('documents', 'StudentController::getDocuments');
    $routes->post('documents', 'StudentController::uploadDocument');
});

