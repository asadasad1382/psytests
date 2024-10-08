<?php

namespace App\Http\Middleware;

use App\Helper\Helper;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (request()->is(Helper::ADMINPATH) || request()->is(Helper::ADMINPATH . '/*')) {
                return route('login', ['type' => 'admin']);
            }
            return route('login');
        }
    }
}
