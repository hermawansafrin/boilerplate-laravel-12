<?php

namespace App\Repositories\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $id = $this->id;
        $input = $this->input;

        $data = User::find($id);
        if ($data === null) {
            return null;
        }

        $data->name = $input['name'];
        $data->email = $input['email'];
        $data->is_active = (int) $input['is_active'];

        if (isset($input['password'])) {
            $data->password = Hash::make($input['password']);
        }

        $data->save();

        $currentFirstRole = $data->roles()->get()[0] ?? null;
        $currentFirstRoleId = $currentFirstRole['id'] ?? null;

        if ($currentFirstRoleId !== $input['role_id']) {
            $pastRole = Role::findOrFail($currentFirstRoleId);
            $data->removeRole($pastRole->name);

            $role = Role::findOrFail($input['role_id']);
            $data->assignRole($role);
        }

        return $data->id ?? null;
    }
}
