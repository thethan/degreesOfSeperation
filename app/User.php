<?php

namespace selftotten;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !!$role->intersect($this->roles);
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions()->contains($permission);
        }

        foreach ($permission as $perm) {
            if ($this->permissions()->contains($perm)) {
                return true;
            }
        }
    }

    public function permissions()
    {
        $permissions = [];
        $roles = Role::with('permissions')->get();
        foreach ($roles as &$role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }
        return collect($permissions);
    }

    public function assignRoles($role)
    {
        return $this->roles()->save(
            Role::where('name', $role->name)->firstOrFail()
        );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function owns($related)
    {
        return $this->id == $related->user_id;
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
