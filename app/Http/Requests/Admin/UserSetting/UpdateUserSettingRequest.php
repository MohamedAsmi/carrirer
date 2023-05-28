<?php

namespace App\Http\Requests\Admin\UserSetting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required',
            'setting_id' => 'required',
            'setting_val' => 'required',
            'setting_parent_id' => 'required',
        ];
    }
}
