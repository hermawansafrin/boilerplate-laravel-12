<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
     * Prepare for validation
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => (int) $this->route('id'),
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
        ];
    }
}
