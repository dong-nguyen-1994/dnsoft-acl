<?php

namespace Dnsoft\Acl\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
