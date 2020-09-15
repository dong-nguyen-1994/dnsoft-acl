<?php

use Illuminate\Contracts\Auth\Authenticatable;

if (!function_exists('admin_can')) {
    /**
     * Check admin user has permission
     *
     * @param $permission
     * @return bool
     */
    function admin_can($permission)
    {
        /** @var \Dnsoft\Acl\Models\Admin $user */
        $user = Auth::guard('admin')->user();

        if ($user && $user->hasPermission($permission)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('current_admin')) {
    /**
     * Get current admin account
     *
     * @return Authenticatable|\Dnsoft\Acl\Models\Admin|null
     */
    function current_admin()
    {
        return \Illuminate\Support\Facades\Auth::guard('admin')->user();
    }
}
