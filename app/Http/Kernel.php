<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...global middleware...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...web middleware...
        ],
        'api' => [
            // ...api middleware...
        ],
    ];

    /**
     * The middleware aliases for the application.
     *
     * In recent Laravel versions this property is named $middlewareAliases
     * instead of the older $routeMiddleware. Register aliases here so the
     * router can resolve middleware by short name.
     */
    protected $middlewareAliases = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        // ...other route middleware...
    ];

    /**
     * The application's route middleware.
     *
     * @var array<string, class-string>
     */
    //protected $routeMiddleware = [
       // 'admin' => \App\Http\Middleware\AdminMiddleware::class,
        // ...other route middleware...
    //];
}
