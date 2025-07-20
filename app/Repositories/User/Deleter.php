<?php

namespace App\Repositories\User;

use App\Models\User;

/**
 * Class for delete data process
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
        $data = User::find($id);

        if ($data) {
            $roles = $data->roles()->get();

            /** detach all roles from this user */
            foreach ($roles as $role) {
                $data->removeRole($role->name);
            }

            $data->delete();
        }
    }
}
