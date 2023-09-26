<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * @property-read array $publishers
 */
class StandPublishersUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'publishers' => [
                'required',
                'array',
            ],
            'publishers.*' => [
                'required',
                Rule::exists(User::TABLE, 'id')
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => false, 'message' => $validator->errors()], 422));
    }
}
