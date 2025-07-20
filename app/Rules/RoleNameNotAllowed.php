<?php

namespace App\Rules;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RoleNameNotAllowed implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleanStringFromSpace = trim($value);
        $value = strtolower($cleanStringFromSpace);

        if (in_array($value, Role::getNamesCannotAllowed())) {
            $fail(__('validation.role_name_not_allowed'));
        }
    }
}
