<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    public function role()
    {
      return $this->hasOne(Role::class);
    }

    public function permission()
    {
      return $this->hasOne(Permission::class);
    }
}