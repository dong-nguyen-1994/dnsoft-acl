<?php

namespace Dnsoft\Acl\Facades;

use Dnsoft\Acl\Contracts\PermissionManagerInterface;
use Illuminate\Support\Facades\Facade;

class Permission extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionManagerInterface::class;
    }
}
