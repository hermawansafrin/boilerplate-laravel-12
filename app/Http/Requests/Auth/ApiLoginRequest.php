<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\APIRequest;

class ApiLoginRequest extends APIRequest
{
    /**
     * @var array
     */
    use RuleTrait;

    /**
     * Prepare the data for validation.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'check' => 'true', // only for check is credentials match or not
            'email' => strtolower($this->email), // lowercase email
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
            'email' => $this->getEmailRules(),
            'password' => $this->getPasswordRules(),
        ];
    }
}
