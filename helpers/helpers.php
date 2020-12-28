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
