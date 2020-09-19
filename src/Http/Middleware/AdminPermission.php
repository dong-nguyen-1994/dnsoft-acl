<?php

namespace Dnsoft\Acl\Http\Middleware;

use Dnsoft\Acl\Models\Admin;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param $permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permissions)
    {
        /** @var Admin $user */
        $user = Auth::guard('admin')->user();
        if ($user && $user->hasPermission($permissions)) {
            return $next($request);
        }
        return abort(403);
    }
}
