<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class APIRequest extends FormRequest
{
    use ResponseTrait;

    protected $stopOnFirstFailure = true;

    /**
     * Handle a failed validation attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $firstError = Arr::first($errors);
        $message = is_array($firstError) ? $firstError[0] : $firstError;

        throw new ValidationException($validator, $this->sendError($message, 400));
    }
}
