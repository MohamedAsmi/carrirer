<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateSettingRequest extends FormRequest
{
    use ResponseHelper;

    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('application_level')) {
            $this->merge([
                'application_level' => 0,
            ]);
        }
    }

    public function rules()
    {
        $rules = [
            // 'key' => ['required', 'string', 'max:255', Rule::unique('settings', 'key')
            //     ->whereNull('parent_id')
            //     ->ignore($this->setting, 'id')],
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
