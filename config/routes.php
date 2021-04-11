<?php

declare (strict_types = 1);

use App\Middleware\JWTAuthMiddleware;
use Hyperf\HttpServer\Router\Router;

Router::addGroup('/guest/', function () {
    Router::post('register', [App\Controller\Guest\GuestUserController::class, 'register']);
    Router::post('login', [App\Controller\Guest\GuestUserController::class, 'login']);
});

Router::addGroup('/user/', function () {
    Router::get('info', [App\Controller\User\UserController::class, 'info']);
}, [
    'middleware' => [JWTAuthMiddleware::class],
]);
