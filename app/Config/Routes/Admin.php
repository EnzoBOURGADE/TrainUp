<?php
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth:administrateur'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');

    $routes->group('user', function ($routes) {
        $routes->get('/', 'User::index');
        $routes->get('(:num)', 'User::edit/$1');
        $routes->get('new', 'User::create');
        $routes->post('update', 'User::update');
        $routes->post('insert', 'User::insert');
        $routes->post('switch-active','User::switchActive');
        $routes->get('search', 'User::search');
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

    $routes->group('exercices', function($routes) {
        $routes->get('/', 'Exercices::index');
        $routes->get('create', 'Exercices::create');
        $routes->post('store', 'Exercices::store');
        $routes->get('edit/(:num)', 'Exercices::edit/$1');
        $routes->post('update/(:num)', 'Exercices::update/$1');
        $routes->get('delete/(:num)', 'Exercices::delete/$1');
    });



    $routes->group('category', function($routes) {
        $routes->get('/', 'Category::index');
        $routes->get('create', 'Category::create');
        $routes->post('store', 'Category::store');
        $routes->get('edit/(:num)', 'Category::edit/$1');
        $routes->post('update/(:num)', 'Category::update/$1');
        $routes->get('delete/(:num)', 'Category::delete/$1');
    });



    $routes->group('category_program', function($routes) {
        $routes->get('/', 'CategoryProgram::index');
        $routes->get('create', 'CategoryProgram::create');
        $routes->post('store', 'CategoryProgram::store');
        $routes->get('edit/(:num)', 'CategoryProgram::edit/$1');
        $routes->post('update/(:num)', 'CategoryProgram::update/$1');
        $routes->get('delete/(:num)', 'CategoryProgram::delete/$1');
    });



    $routes->group('series', function($routes) {
        $routes->get('/', 'Series::index');
        $routes->get('create', 'Series::create');
        $routes->post('store', 'Series::store');
        $routes->get('edit/(:num)', 'Series::edit/$1');
        $routes->post('update/(:num)', 'Series::update/$1');
        $routes->get('delete/(:num)', 'Series::delete/$1');
    });



    $routes->group('muscles', function($routes) {
        $routes->get('/', 'Muscles::index');
        $routes->get('create', 'Muscles::create');
        $routes->post('store', 'Muscles::store');
        $routes->get('edit/(:num)', 'Muscles::edit/$1');
        $routes->post('update/(:num)', 'Muscles::update/$1');
        $routes->get('delete/(:num)', 'Muscles::delete/$1');
    });



    $routes->group('workout', function($routes) {
        $routes->get('/', 'Workout::index');
        $routes->get('create', 'Workout::create');
        $routes->post('store', 'Workout::store');
        $routes->get('edit/(:num)', 'Workout::edit/$1');
        $routes->post('update/(:num)', 'Workout::update/$1');
        $routes->get('delete/(:num)', 'Workout::delete/$1');
    });



    $routes->group('friends', function($routes) {
        $routes->get('/', 'Friends::index');
        $routes->get('create', 'Friends::create');
        $routes->post('store', 'Friends::store');
        $routes->get('edit/(:num)', 'Friends::edit/$1');
        $routes->post('update/(:num)', 'Friends::update/$1');
        $routes->get('delete/(:num)', 'Friends::delete/$1');
    });


    $routes->group('friends_request', function($routes) {
        $routes->get('/', 'FriendsRequest::index');
        $routes->get('create', 'FriendsRequest::create');
        $routes->post('store', 'FriendsRequest::store');
        $routes->get('edit/(:num)', 'FriendsRequest::edit/$1');
        $routes->post('update/(:num)', 'FriendsRequest::update/$1');
        $routes->get('delete/(:num)', 'FriendsRequest::delete/$1');
    });

});

