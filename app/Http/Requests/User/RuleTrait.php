<?php

namespace App\Http\Requests\User;

trait RuleTrait
{
    /**
     * Get the validation rules for the id field.
     */
    public function getIdRules(): array
    {
        return ['required', 'integer', 'numeric', 'exists:users,id'];
    }

    /**
     * Get the validation rules for the name field.
     */
    public function getNameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules for the email field.
     */
    public function getEmailRules(): array
    {
        return ['required', 'email', 'max:255', 'unique:users,email', 'email:rfc'];
    }

    /**
     * Get the validation rules for the email field.
     */
    public function getEmailUpdateRules(): array
    {
        $basicRules = $this->getEmailRules();
        $basicRules[3] = 'unique:users,email,' . $this->id; // change unique except specific id

        return $basicRules;
    }

    /**
     * Get the validation rules for the role_id field.
     */
    public function getRoleIdRules(): array
    {
        return ['required', 'exists:roles,id'];
    }

    /**
     * Get the validation rules for the is_active field.
     */
    public function getIsActiveRules(): array
    {
        return ['required', 'in:0,1'];
    }

    /**
     * Get the validation for password rules
     */
    public function getPasswordRules(): array
    {
        return [
            'required', 'string', 'min:6', 'max:12', 'confirmed',
        ];
    }

    /**
     * Get the validation for password update rules
     */
    public function getPasswordUpdateRules(): array
    {
        $basicRules = $this->getPasswordRules();
        $basicRules[0] = 'nullable';

        return $basicRules;
    }

    /**
     * Get the validation for password confirmation rules
     */
    public function getPasswordConfirmationRules(): array
    {
        return [
            'required', 'string', 'min:6', 'max:12', 'same:password',
        ];
    }

    /**
     * Get the validation for password confirmation update rules
     */
    public function getPasswordConfirmationUpdateRules(): array
    {
        $basicRules = $this->getPasswordConfirmationRules();
        $basicRules[0] = 'nullable';

        return $basicRules;
    }
}
