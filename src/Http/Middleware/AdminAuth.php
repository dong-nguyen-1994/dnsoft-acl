<?php

namespace Dnsoft\Acl\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class AdminAuth {

    protected $auth;

    protected $guard = 'admin';

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
