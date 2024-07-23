<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            "name" => "required|min:5|max:20",
            "email" => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->request->get('id')),
            ],
            "password" => "required|min:8", 
            "jenis_kelamin" => [
                "required",
                Rule::in(["Pria", "Perempuan"])
            ], 
            'role_id' => 'required|exists:roles,id',
            'gambar_ktp' => 'required|',
            'gambar_profil' => 'required|',
        ];
    }
    public function messages(): array
    { 
        
        return
        [ 
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa karakter.',
            'name.min' => 'Nama harus lebih dari atau sama dengan :min karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'role_id.required' => 'Level tidak boleh kosong.',
            'role_id.exists' => '   Pilih Peran User Dengan Benar !!',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password tidak boleh kurang dari :min karakter.',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong.',
            'jenis_kelamin.in' => 'Jenis Kelamin tidak terdaftar.', 
            'gambar_profil.required' => 'Gambar Profil tidak boleh kosong.',
            'gambar_ktp.required' => 'Gambar KTP tidak boleh kosong.',
        ]; 
    }
    
}