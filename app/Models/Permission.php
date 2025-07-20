<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{
    /**
     * Relation to child permissions if any
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function child()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }
}
