<?php

namespace Dnsoft\Acl\Traits;

trait HasPermission
{
    public function hasPermission($key)
    {
        if ($this->is_admin) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role->is_admin) {
                return true;
            }
        }
    }
}
