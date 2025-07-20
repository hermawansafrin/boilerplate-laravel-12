<?php

namespace App\Rules;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RoleIdNotAllowed implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array($value, Role::IDS_CANNOT_EDIT_OR_DELETE)) {
            $fail(__('validation.exists', ['attribute' => 'Id']));
        }
    }
}
