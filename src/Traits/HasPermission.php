<?php

namespace Dnsoft\Acl\Traits;

use Illuminate\Support\Collection;

trait HasPermission
{
    protected $allPermissions;

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
        $this->loadAllPermissions();

        return $this->allPermissions->contains($key);
    }

    public function loadAllPermissions()
    {
        foreach ($this->roles as $role) {
            $rolePermissions = new Collection(json_decode($role->permissions, true));
            $this->allPermissions = $this->allPermissions->merge($rolePermissions)->unique();
        }
        $this->allPermissions = $this->permissions;
    }
}
