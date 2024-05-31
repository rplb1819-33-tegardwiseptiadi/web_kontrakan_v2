<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
        // rent = kontrakan
        // occupant = penyewa
        return [
            "user_id" => "required", 
            "rent_id" => "required", 
            "tgl_transaksi" => "required",   
            "status_transaksi" => "required", 
            "gambar_transaksi" => "required", 
            
        ];
    }

   
    public function messages(): array
    { 
        return
        [  
            'user_id.required' => 'Nama Penghuni tidak boleh kosong.', 
            'rent_id.required' => 'Nama kontrakan tidak boleh kosong.', 
            'tgl_transaksi.required' => 'Tanggal Transaksi tidak boleh kosong.',  
            'status_transaksi.required' => 'Status Transaksi tidak boleh kosong.', 
            'gambar_transaksi.required' => 'Gambar Transaksi tidak boleh kosong.', 
             
        ]; 
    } 
}
