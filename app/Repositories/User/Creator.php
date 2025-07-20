<?php

namespace App\Repositories\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $input = $this->input;

        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->is_active = (int) $input['is_active'];
        $user->save();

        $role = Role::findOrFail((int) $input['role_id']);
        $user->assignRole($role);

        $dataId = $user->id;

        return $dataId ?? null;
    }
}
