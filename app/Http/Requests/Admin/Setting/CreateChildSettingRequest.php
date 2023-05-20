<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreateChildSettingRequest extends FormRequest
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
        $parentId = $this->route('setting');
        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('settings', 'name')
                ->where('parent_id', $parentId)],
            'application_level' => ['nullable', 'boolean'],
            'parent_id' => ['required', 'exists:settings,id'],
            'value' => ['required', 'string'],
        ];

        return $rules;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $error = $validator->errors()->first();
        $response = $this->_response('error', $error, [], 422);
        throw new ValidationException($validator, $response);
    }
}
