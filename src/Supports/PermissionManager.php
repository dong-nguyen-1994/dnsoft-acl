<?php

namespace Dnsoft\Acl\Supports;

use Dnsoft\Acl\Contracts\PermissionManagerInterface;

class PermissionManager implements PermissionManagerInterface
{
    protected $permissions = [];

    /**
     * @return array
     */
    public function all()
    {
        return $this->permissions;
    }

    public function add($key, $label)
    {

    }
}
