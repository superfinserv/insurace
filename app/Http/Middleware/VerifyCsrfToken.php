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
       'profile/video-upload', 'health-insurance/insured-success/*','moter-insurance/insured-success/*','insurance/policy/cancel/hdfcergo_motor',
    ];
}
