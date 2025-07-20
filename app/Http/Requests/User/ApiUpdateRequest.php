<?php

namespace App\Http\Requests\User;

use App\Http\Requests\APIRequest;

class ApiUpdateRequest extends APIRequest
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
     * Prepare the data for validation.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => $this->getIdRules(),
            'name' => $this->getNameRules(),
            'email' => $this->getEmailUpdateRules(),
            'role_id' => $this->getRoleIdRules(),
            'is_active' => $this->getIsActiveRules(),
            'password' => $this->getPasswordUpdateRules(),
            'password_confirmation' => $this->getPasswordConfirmationUpdateRules(),
        ];
    }
}
