<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccupantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    { 
        return [ 
            // "nama_penghuni" => "required|min:5", 
            "umur_penghuni" => "required", 
            "jenis_kelamin" => "required", 
            "status_penghuni" => "required",  
        ]; 
    }

    public function messages(): array
    { 
        return
        [  
            // 'nama_penghuni.required' => 'Nama Penghuni tidak boleh kosong.', 
            'nama_penghuni.min' => 'Nama Penghuni harus minimal :min karakter.',    
            'umur_penghuni.required' => 'Umur Penghuni tidak boleh kosong.',    
            'jenis_kelamin.required' => 'Jenis kelamin Penghuni tidak boleh kosong.',    
            'status_penghuni.required' => 'Status Penghuni tidak boleh kosong.',   
        ]; 
    } 
}
