<?php
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->group('users', function ($routes) {
        $routes->get('all', 'User::index');
        $routes->get('(:num)', 'User::show/$1');
    });

    $routes->group('exercice', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Exercice::index');
        $routes->get('(:num)', 'Exercice::show/$1');
        $routes->get('new', 'Exercices::create');
        $routes->get('(:num)', 'Exercices::edit/$1');
        $routes->post('save', 'Exercices::save');
        $routes->post('delete', 'Exercices::delete');
    });

    $routes->group('auth', function ($routes) {
        $routes->post('login', 'Auth::login');
    });

    $routes->group('category', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Category::index');
        $routes->get('(:num)', 'Category::show/$1');
        $routes->get('new', 'Category::create');
        $routes->get('(:num)', 'Category::edit/$1');
        $routes->post('save', 'Category::save');
        $routes->post('delete', 'Category::delete');
    });

    $routes->group('category-program', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'CategoryProgram::index');
        $routes->get('(:num)', 'CategoryProgram::show/$1');
        $routes->get('new', 'CategoryProgram::create');
        $routes->get('(:num)', 'CategoryProgram::edit/$1');
        $routes->post('save', 'CategoryProgram::save');
        $routes->post('delete', 'CategoryProgram::delete');
    });

    $routes->group('friends', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Friends::index');
        $routes->get('(:num)', 'Friends::show/$1');
        $routes->get('new', 'Friends::create');
        $routes->get('(:num)', 'Friends::edit/$1');
        $routes->post('save', 'Friends::save');
        $routes->post('delete', 'Friends::delete');
    });

    $routes->group('friends-request', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'FriendsRequest::index');
        $routes->get('(:num)', 'FriendsRequest::show/$1');
        $routes->get('new', 'FriendsRequest::create');
        $routes->get('(:num)', 'FriendsRequest::edit/$1');
        $routes->post('save', 'FriendsRequest::save');
        $routes->post('delete', 'FriendsRequest::delete');
    });

    $routes->group('muscles', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Muscles::index');
        $routes->get('(:num)', 'Muscles::show/$1');
        $routes->get('new', 'Muscles::create');
        $routes->get('(:num)', 'Muscles::edit/$1');
        $routes->post('save', 'Muscles::save');
        $routes->post('delete', 'Muscles::delete');
    });

    $routes->group('program', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Program::index');
        $routes->get('(:num)', 'Program::show/$1');
        $routes->get('new', 'Program::create');
        $routes->get('(:num)', 'Program::edit/$1');
        $routes->post('save', 'Program::save');
        $routes->post('delete', 'Program::delete');
    });

    $routes->group('series', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Series::index');
        $routes->get('(:num)', 'Series::show/$1');
        $routes->get('new', 'Series::create');
        $routes->get('(:num)', 'Series::edit/$1');
        $routes->post('save', 'Series::save');
        $routes->post('delete', 'Series::delete');
    });

    $routes->group('workout', ['filter' => 'apitoken'], function ($routes) {
        $routes->get('all', 'Workout::index');
        $routes->get('(:num)', 'Workout::show/$1');
        $routes->get('new', 'Workout::create');
        $routes->get('(:num)', 'Workout::edit/$1');
        $routes->post('save', 'Workout::save');
        $routes->post('delete', 'Workout::delete');
    });


});
