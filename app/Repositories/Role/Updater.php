<?php

namespace App\Repositories\Role;

use App\Models\Permission;
use App\Models\Role;

/**
 * Class for updating role on db
 */
class Updater
{
    private int $id;

    private array $input = [];

    /**
     * constructor
     */
    public function prepare(int $id, array $input): self
    {
        $this->id = $id;
        $this->input = $input;

        return $this;
    }

    /**
     * Do updating data on db with choosing schema transaction
     */
    public function execute(): ?int
    {
        $dataId = null;

        $input = $this->input;
        $permissionIds = $input['permission_ids'];
        $permissionIds = Helper::adjustPermissionIds($permissionIds);

        $role = Role::findOrFail($this->id);
        $role->name = $input['name'];
        $role->guard_name = 'web';

        $role->save();

        /** clear permission first */
        $role->syncPermissions([]);

        foreach ($permissionIds as $permissionId) {
            $permission = Permission::findOrFail($permissionId);
            $role->givePermissionTo($permission);
        }

        $dataId = $role->id;

        return $dataId;
    }
}
