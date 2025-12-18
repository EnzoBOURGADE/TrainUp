<?php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:administrateur'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->group('user', function ($routes) {
        $routes->get('/', 'User::index');
        $routes->get('(:num)', 'User::edit/$1');
        $routes->get('new', 'User::create');
        $routes->post('update/(:num)', 'User::update/$1');
        $routes->post('insert', 'User::insert');
        $routes->post('save', 'User::save');
        $routes->post('switch-active','User::switchActive');
        $routes->get('search', 'User::search');
        $routes->post('delete', 'User::delete');
    });

    $routes->group('user-permission', function ($routes) {
       $routes->get('/', 'UserPermission::index');
       $routes->post('update', 'UserPermission::update');
       $routes->post('insert', 'UserPermission::insert');
       $routes->post('delete', 'UserPermission::delete');
    });

    $routes->group('program', function ($routes) {
       $routes->get('/', 'Program::index');
       $routes->get('new', 'Program::create');
       $routes->get('(:num)', 'Program::edit/$1');
       $routes->post('save', 'Program::save');
       $routes->post('delete', 'Program::delete');
    });

    $routes->group('exercices', function ($routes) {
        $routes->get('/', 'Exercices::index');
        $routes->get('new', 'Exercices::create');
        $routes->get('(:num)', 'Exercices::edit/$1');
        $routes->post('save', 'Exercices::save');
        $routes->post('delete', 'Exercices::delete');
        $routes->get('info/(:num)', 'Exercices::info/$1');
        $routes->get('search', 'Exercices::search');
    });

    $routes->group('category', function ($routes) {
        $routes->get('/', 'Category::index');
        $routes->get('new', 'Category::create');
        $routes->get('(:num)', 'Category::edit/$1');
        $routes->post('save', 'Category::save');
        $routes->post('delete', 'Category::delete');
    });

    $routes->group('category-program', function ($routes) {
        $routes->get('/', 'CategoryProgram::index');
        $routes->get('new', 'CategoryProgram::create');
        $routes->get('(:num)', 'CategoryProgram::edit/$1');
        $routes->post('save', 'CategoryProgram::save');
        $routes->post('delete', 'CategoryProgram::delete');
    });

    $routes->group('series', function ($routes) {
        $routes->get('/', 'Series::index');
        $routes->get('new', 'Series::create');
        $routes->get('(:num)', 'Series::edit/$1');
        $routes->post('save', 'Series::save');
        $routes->post('delete', 'Series::delete');
    });

    $routes->group('muscles', function ($routes) {
        $routes->get('/', 'Muscles::index');
        $routes->get('new', 'Muscles::create');
        $routes->get('(:num)', 'Muscles::edit/$1');
        $routes->post('save', 'Muscles::save');
        $routes->post('delete', 'Muscles::delete');
    });

    $routes->group('workout', function ($routes) {
        $routes->get('/', 'Workout::index');
        $routes->get('new/(:num)', 'Workout::create/$1');
        $routes->get('(:num)', 'Workout::edit/$1');
        $routes->post('save', 'Workout::save');
        $routes->post('delete', 'Workout::delete');
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

