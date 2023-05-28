<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Helper\ResponseHelper;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateSettingRequest extends FormRequest
{
    use ResponseHelper;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (!$this->filled('application_level')) {
            $this->merge([
                'application_level' => 0,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'key' => ['required', 'string', 'max:255', Rule::unique('settings', 'key')
                ->whereNull('parent_id')],
            'application_level' => ['nullable', 'boolean'],
            'value' => ['required', 'string'],
        ];

        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $error = $validator->errors()->first();
        $response = $this->response('error', $error, [], 422);
        throw new ValidationException($validator, $response);
    }
}
