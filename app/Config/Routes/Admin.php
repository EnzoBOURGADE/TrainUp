<?php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:administrateur'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->group('user', function ($routes) {
        $routes->get('/', 'User::index');
        $routes->get('(:any)', 'User::createOrEdit/$1');
        $routes->post('insert', 'User::insert');
        $routes->post('save', 'User::save');
        $routes->post('switch-active','User::switchActive');
        $routes->get('search', 'User::search');
        $routes->post('delete', 'User::delete');
    });

    $routes->group('user-permission', function ($routes) {
        $routes->get('/', 'UserPermission::index');
        $routes->get('(:any)', 'UserPermission::createOrEdit/$1');
        $routes->post('save', 'UserPermission::save');
        $routes->post('delete', 'UserPermission::delete');
    });

    $routes->group('program', function ($routes) {
        $routes->get('/', 'Program::index');
        $routes->get('(:any)', 'Program::createOrEdit/$1');
        $routes->post('save', 'Program::save');
        $routes->post('delete', 'Program::delete');
    });

    $routes->group('exercices', function ($routes) {
        $routes->get('search', 'Exercices::search');
        $routes->get('info/(:num)', 'Exercices::info/$1');
        $routes->post('save', 'Exercices::save');
        $routes->post('delete', 'Exercices::delete');
        $routes->get('(:any)', 'Exercices::createOrEdit/$1');
        $routes->get('/', 'Exercices::index');

    });

    $routes->group('category', function ($routes) {
        $routes->get('/', 'Category::index');
        $routes->get('(:any)', 'Category::createOrEdit/$1');
        $routes->post('save', 'Category::save');
        $routes->post('delete', 'Category::delete');
    });

    $routes->group('difficulty', function ($routes) {
        $routes->get('/', 'Difficulty::index');
        $routes->get('(:any)', 'Difficulty::createOrEdit/$1');
        $routes->post('save', 'Difficulty::save');
        $routes->post('delete', 'Difficulty::delete');
    });

    $routes->group('category-program', function ($routes) {
        $routes->get('/', 'CategoryProgram::index');
        $routes->get('(:any)', 'CategoryProgram::createOrEdit/$1');
        $routes->post('save', 'CategoryProgram::save');
        $routes->post('delete', 'CategoryProgram::delete');
    });

    $routes->group('series', function ($routes) {
        $routes->get('/', 'Series::index');
        $routes->get('(:any)', 'Series::createOrEdit/$1');
        $routes->post('save', 'Series::save');
        $routes->post('delete', 'Series::delete');
    });

    $routes->group('muscles', function ($routes) {
        $routes->get('/', 'Muscles::index');
        $routes->get('(:any)', 'Muscles::createOrEdit/$1');
        $routes->post('save', 'Muscles::save');
        $routes->post('delete', 'Muscles::delete');
    });

    $routes->group('workout', function ($routes) {
        $routes->get('(:num)', 'Workout::createOrEdit/$1');
        $routes->get('(:num)/(:any)', 'Workout::createOrEdit/$1/$2');
        $routes->post('save', 'Workout::save');
        $routes->get('delete/(:num)/(:any)', 'Workout::delete/$1/$2');
    });

    $routes->group('friends', function ($routes) {
        $routes->get('/', 'Friends::index');
        $routes->post('delete', 'Friends::delete');
    });

    $routes->group('friends-request', function ($routes) {
        $routes->get('/', 'FriendsRequest::index');
        $routes->get('new', 'FriendsRequest::create');
        $routes->post('save', 'FriendsRequest::save');
    });

});

