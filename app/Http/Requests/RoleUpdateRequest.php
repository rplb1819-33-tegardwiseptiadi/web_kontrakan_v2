<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // biar bisa membuat data
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            "name" => 'required', 
        ]; 
        return $rules;
    }

    public function messages(): array
    {
        return
            [
                'name.required' => 'Nama Peran  Wajib Diisi !!!',  
            ];
    }
}
