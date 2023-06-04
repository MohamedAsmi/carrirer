<?php

namespace App\Http\Requests\Admin\CsvMapping;

use App\Http\Helper\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UploadCsvRequest extends FormRequest
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
            'csv_file' => 'required|mimes:csv,txt',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSV File is required',
            'csv_file.mimes' => 'CSV File must be in proper file type',
        ];
    }

    // protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     $error = $validator->errors()->first();
    //     $response = $this->response('error', $error, [], 422);
    //     throw new ValidationException($validator, $response);
    // }
}
