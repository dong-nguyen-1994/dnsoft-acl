<?php

namespace Dnsoft\Acl\Traits;

use Illuminate\Support\Collection;

trait HasPermission
{
    protected $allPermissions;

    protected $loaded = false;

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


    protected function loadPermission()
    {
        if (!$this->loaded) {
            $this->allPermissions = new Collection(json_decode($this->permissions, true));
        }

        foreach ($this->roles as $role) {
            $rolePermissions = new Collection(json_decode($role->permissions, true));
            $this->allPermissions = $this->allPermissions->merge($rolePermissions)->unique();
        }
    }

    public function allPermissions()
    {
        $this->loadPermission();

        return $this->allPermissions;
    }
}
