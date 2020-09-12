<?php

namespace Dnsoft\Acl\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class AdminAuth {

    protected $auth;

    protected $guard = 'admin';

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $this->authenticate($request);
        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     * @param  Request  $request
     * @return void
     * @throws AuthenticationException
     */
    protected function authenticate($request)
    {
        if ($this->auth->guard($this->guard)->check()) {
            return $this->auth->shouldUse($this->guard);
        }
        $this->unauthenticated($request);
    }


    protected function unauthenticated($request)
    {
        throw new AuthenticationException(
            'Unauthenticated.', [$this->guard], $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @param Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('admin.login');
        }
    }
}
