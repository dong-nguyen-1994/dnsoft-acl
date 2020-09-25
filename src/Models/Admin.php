<?php

namespace Dnsoft\Acl\Models;

use Dnsoft\Acl\Traits\HasPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasPermission;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at',
        'permissions',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }
}
