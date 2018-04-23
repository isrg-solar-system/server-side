<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'api/data','/api/download/file','api/input/data','/api/get/data','/api/warning/create','/api/warning/delete','/api/warning/update','/broadcasting/auth'
    ];
    protected $except_urls = [
        'api/data','/api/download/file','api/input/data','/api/get/data','/api/warning/create','/api/warning/delete','/api/warning/update','/broadcasting/auth'
    ];


}
