<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateChildSettingRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $settingId = $this->route('child');
        $parentId = $this->input('setting');

        $rules = [
            'key' => ['required', 'string', 'max:255', Rule::unique('settings', 'key')
                ->where('parent_id', $parentId)
                ->where('id', '<>', $settingId)
                ->ignore($this->settingId, 'id')],
            'application_level' => ['nullable', 'boolean'],
            'parent_id' => ['required', 'exists:settings,id'],
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
