<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // ADICIONE ESTA LINHA ABAIXO:
        // Ela avisa ao Laravel para redirecionar usuários logados direto para o estoque!
        $middleware->redirectTo(guests: '/login', users: '/vehicles');

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
