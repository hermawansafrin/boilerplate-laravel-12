<?php

namespace App\Repositories\Role;

use App\Models\Permission;
use App\Models\Role;

class Creator
{
    private array $input = [];

    /**
     * Prepare input data
     */
    public function prepare(array $input): self
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Execute process for create data
     */
    public function execute(): ?int
    {
        $dataId = null;

        $input = $this->input;
        $permissionIds = $input['permission_ids'];

        // give permission_id valid
        $permissionIds = Helper::adjustPermissionIds($permissionIds);

        $role = Role::create([
            'name' => $input['name'],
            'guard_name' => 'web',
        ]);

        $dataId = $role->id ?? null;

        if ($dataId === null) {
            return $dataId;
        }

        foreach ($permissionIds as $permissionId) {
            // give permission one by one
            $permission = Permission::findOrFail($permissionId);

            // add role
            $role->givePermissionTo($permission);
        }

        return $dataId;
    }
}
