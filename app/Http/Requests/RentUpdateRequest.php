<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "nama_kontrakan" => "required|min:5", 
            "tipe_kontrakan" => "required", 
            "kapasitas_kontrakan" => "required", 
            "harga_kontrakan" => "required",  
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
            'alamat_kontrakan.required' => 'Alamat kontrakan tidak boleh kosong.', 
        ]; 
    } 
}
