<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

if (!function_exists('is_admin'))
{
    /**
     * Check account is administrator
     *
     * @return bool
     */
    function is_admin()
    {
        /** @var \Dnsoft\Acl\Models\Admin $user */
        $user = Auth::guard('admin')->user();

        if ($user->is_admin) {
            return true;
        }

        foreach ($user->roles as $role) {
            if ($role->is_admin) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('admin_can'))
{
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

if (!function_exists('get_roles_options'))
{
    /**
     * @return array
     */
    function get_roles_options(): array
    {
        $options = [];

        $categoryTreeList = \Dnsoft\Acl\Models\Role::all();
        foreach ($categoryTreeList as $item) {
            $options[] = [
                'value' => $item->id,
                'label' => trim(str_pad('', $item->depth * 3, '-')).' '.$item->name,
            ];
        }

        return $options;
    }
}

if (!function_exists('current_admin'))
{
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
