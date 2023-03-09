<?php

namespace DnSoft\Acl\Models;

use DnSoft\Acl\Traits\HasPermission;
use DnSoft\Core\Traits\CacheableTrait;
use DnSoft\Media\Traits\HasMediaTraitFileManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasPermission;
    use CacheableTrait;
    use HasMediaTraitFileManager;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at',
        'permissions',
        'avatar',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

    public function setAvatarAttribute($value)
    {
        static::saved(function ($model) use ($value) {
            $model->attachMediaFileManager($value);
        });
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMedia('admin');
    }
}
