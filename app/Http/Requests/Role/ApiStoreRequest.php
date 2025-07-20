<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\APIRequest;

/**
 * Validation request for create name rules
 */
class ApiStoreRequest extends APIRequest
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
            'permission_ids' => $this->getPermissionIdsRules(),
        ];
    }
}
