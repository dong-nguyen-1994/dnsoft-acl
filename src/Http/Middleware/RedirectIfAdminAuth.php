<?php

namespace Dnsoft\Acl\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RedirectIfAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {
            $config = config('acl.redirect_if_authenticated', config('core.admin_prefix'));

            $redirect = is_callable($config) ? $config() : $config;

            return redirect($redirect);
        }
        return $next($request);
    }
}
