<?php

namespace DnSoft\Acl\Facades;

use DnSoft\Acl\Contracts\PermissionManagerInterface;
use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionManagerInterface::class;
    }
}
