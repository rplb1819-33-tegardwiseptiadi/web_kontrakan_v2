<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentStoreRequest extends FormRequest
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
            "nama_kontrakan" => "required|min:5", 
            "tipe_kontrakan" => "required", 
            "kapasitas_kontrakan" => "required", 
            "harga_kontrakan" => "required", 
            "gambar_kontrakan" => "required", 
            "status_kontrakan" => "required", 
            "alamat_kontrakan" => "required|min:5", 
        ];
    }

    public function messages(): array
    { 
        return
        [  
            'nama_kontrakan.required' => 'Nama kontrakan tidak boleh kosong.', 
            'nama_kontrakan.min' => 'Nama kontrakan harus minimal :min karakter.', 
            'tipe_kontrakan.required' => 'Tipe kontrakan tidak boleh kosong.', 
            'kapasitas_kontrakan.required' => 'Kapasitas kontrakan tidak boleh kosong.', 
            'harga_kontrakan.required' => 'Harga kontrakan tidak boleh kosong.', 
            'gambar_kontrakan.required' => 'Gambar kontrakan tidak boleh kosong.', 
            'status_kontrakan.required' => 'Status kontrakan tidak boleh kosong.', 
            'alamat_kontrakan.required' => 'Alamat kontrakan tidak boleh kosong.', 
        ]; 
    } 
   
}
