<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'reference' => 'nullable|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'address3' => 'nullable|string',
            'street' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
            'rigion' => 'required|string',
            'service_id' => 'required|string',
        ];
    }
}
