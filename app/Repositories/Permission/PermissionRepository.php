<?php

namespace App\Repositories\Permission;

class PermissionRepository
{
    /**
     * get all permission
     */
    public function get()
    {
        $getter = app(Getter::class);

        return $getter->getAll(true, true);
    }
}
