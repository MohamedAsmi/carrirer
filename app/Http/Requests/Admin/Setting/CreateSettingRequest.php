<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSettingRequest extends FormRequest
{
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
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('settings')->where(function ($query) {
                return $query->where('parent_id', null);
            })],
            'value' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:settings,id'],
        ];
    }
}
