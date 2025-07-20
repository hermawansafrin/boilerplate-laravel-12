<?php

namespace App\Repositories\Role;

use App\Models\Role;

/**
 * Special class for delete process
 */
class Deleter
{
    private int $id;

    private array $option = [];

    /**
     * Perform preparation process before delete
     */
    public function prepare(int $id, array $options): self
    {
        $this->id = $id;
        $this->option = $options;

        return $this;
    }

    /**
     * Perform delete process with transaction check
     */
    public function execute(): void
    {
        $id = $this->id;

        $role = Role::findOrFail($id);

        if ($role) {
            // delete role permissions data
            $role->syncPermissions([]); // delete permissions data
            // delete role data
            $role->delete();
        }
    }
}
