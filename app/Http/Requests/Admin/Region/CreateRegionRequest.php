<?php

namespace App\Http\Requests\Admin\Region;

use App\Http\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateRegionRequest extends FormRequest
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

        return [
            'code' => 'required|string|max:255|unique:regions',
            'name' => 'required|string|max:255',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $error = $validator->errors()->first();
        $response = $this->response('error', $error, [], 422);
        throw new ValidationException($validator, $response);
    }
}
