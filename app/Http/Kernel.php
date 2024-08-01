<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Other properties

    protected $middlewareGroups = [
        'web' => [
            // Other middleware
            \App\Http\Middleware\Authenticate::class,
        ],
        'auth' => [
            \App\Http\Middleware\Authenticate::class,
        ],
    ];

    // Other methods
}
