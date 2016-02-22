<?php

namespace selftotten;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
