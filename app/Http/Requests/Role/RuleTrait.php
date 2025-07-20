<?php

namespace App\Http\Requests\Role;

use App\Models\Role;
use App\Rules\RoleIdNotAllowed;
use App\Rules\RoleNameNotAllowed;

/**
 * Trait related to validation
 */
trait RuleTrait
{
    /**
     * Validation for id
     */
    public function getIdRules(): array
    {
        return [
            'bail',
            'required',
            'integer',
            'numeric',
            'exists:roles,id',
        ];
    }

    /**
     * Validation for id cannot be changed or deleted
     */
    public function getIdCannotChagedOrDeletedRules(): array
    {
        return array_merge($this->getIdRules(), [
            new RoleIdNotAllowed,
        ]);
    }

    /**
     * Base role validation name rules
     */
    public function getBaseNameRules(): array
    {
        return [
            'required',
            'string',
            'min:5',
            'max:40',
            'bail',
        ];
    }

    /**
     * Role validation for role name
     */
    public function getNameRules(): array
    {
        return array_merge($this->getBaseNameRules(), [
            'unique:' . Role::class . ',name',
            new RoleNameNotAllowed,
        ]);
    }

    /**
     * Process role name validation during update
     * (must be unique, except for the related id)
     */
    public function getNameUpdateRules(int $roleId): array
    {
        return array_merge($this->getBaseNameRules(), [
            'unique:' . Role::class . ',name,' . $roleId,
            new RoleNameNotAllowed,
        ]);
    }

    /**
     * Validation for permission ids
     */
    public function getPermissionIdsRules(): array
    {
        return [
            'bail',
            'required',
            'array',
            'min:1',
        ];
    }
}
