<?php

namespace DnSoft\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_user');
    }

    public function hasAccess(array $permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermision($permissions)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermision($permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
