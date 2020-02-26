<?php

namespace App\Traits;

use App\Models\Allow;
use App\Models\Group;
use Carbon\Carbon;

trait HasPermissions
{
    public function withdrawPermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        return $this->allows()->detach($permissions);
    }

    protected function getAllPermissions(array $permissions)
    {
        return $this->allows()->whereIn('slug', $permissions)->get();
    }

    public function allows()
    {
        return $this->belongsToMany(Allow::class, 'user_allows');
    }

    public function refreshPermissions(...$permissions)
    {
        $this->allows()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        //dd($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->allows()->saveMany($permissions);
        return $this;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission);
    }

    protected function hasPermission($permission)
    {
        //TODO
        //cache this
        $expire_at = Carbon::now()->addMinutes(10);

        $allow = cache()->remember('user_allow_'.auth()->user()->id, $expire_at, function () use ($permission) {
            return (bool)$this->allows()->where('slug', $permission->slug)->count();
        });
        return $allow;
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->group as $group) {
            if ($this->group()->contains($group)) {
                return true;
            }
        }
        return false;
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function hasRole(...$groups)
    {
        foreach ($groups as $group) {
            if ($this->group()->contains('slug', $group)) {
                return true;
            }
        }
        return false;
    }
}
