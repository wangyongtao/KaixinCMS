<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App;

use App\Models\Roles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
//    use HasApiToken, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'accountname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * roles.
     */
    public function roles()
    {
        $tableName = 'rbac_user_role';

        return $this->belongsToMany(
            Roles::class,
            $tableName,
            'user_id',
            'role_id'
        );
    }

    /**
     * Checks access.
     *
     * @param $permission
     *
     * @return bool
     */
    public function hasAccess($permission)
    {
        // check the permission
        foreach ($this->roles as $roleVal) {
            if ($roleVal->hasAccess($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($roleSlug)
    {
        return $this->roles()->where('role_slug', $roleSlug)->count() >= 1;
    }

    public function inRole($roleSlug)
    {
        return $this->roles()->where('role_slug', $roleSlug)->count() >= 1;
    }
}
