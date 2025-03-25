<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
<<<<<<< HEAD
use App\Http\Middleware\AdminMiddleware;
=======
>>>>>>> 1caad101946840d550a27e6cd657752c6768a002

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
<<<<<<< HEAD
        $middleware->append(AdminMiddleware::class);
=======
        //
>>>>>>> 1caad101946840d550a27e6cd657752c6768a002
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
