<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateThingRequest extends FormRequest
{
    public $validator = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'one' => 'string|max:255',
            'two' => 'string|max:255',
            'three' => 'string|max:255',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
