<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public $timestamps = false;
    public $table = 'role_has_permissions';
}
