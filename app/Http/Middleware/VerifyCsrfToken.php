<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array   定义需要排除检测的路由
     */
    protected $except = [
        'admin/business/del',
        'admin/banner/home',
        'admin/business/editOption'
    ];
}
