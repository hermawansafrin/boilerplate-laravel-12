<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use RuleTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => $this->getNameRules(),
            'email' => $this->getEmailRules(),
            'role_id' => $this->getRoleIdRules(),
            'is_active' => $this->getIsActiveRules(),
            'password' => $this->getPasswordRules(),
            'password_confirmation' => $this->getPasswordConfirmationRules(),
        ];
    }
}
