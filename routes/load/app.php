<?php

use Pecee\SimpleRouter\SimpleRouter;

/**
 * Home routes
 */
SimpleRouter::group([
    'middleware' => Modules\App\Middleware::class,
    'prefix' => '/',
    'namespace' => 'Modules\App\Home\Controllers',
], function () {
    SimpleRouter::get('/', 'HomeController@index');
});

/**
 * Auth routes
 */
SimpleRouter::group([
    'middleware' => Modules\App\Middleware::class,
    'prefix' => '/auth',
    'namespace' => 'Modules\App\Auth\Controllers',
], function () {
    SimpleRouter::post('/refresh', 'AuthController@refresh');
    SimpleRouter::post('/signin', 'AuthController@signIn');
    SimpleRouter::post('/signup', 'AuthController@signUp');
    SimpleRouter::post('/signout', 'AuthController@signOut');
});
