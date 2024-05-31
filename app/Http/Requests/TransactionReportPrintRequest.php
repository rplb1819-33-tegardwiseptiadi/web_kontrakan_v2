<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionReportPrintRequest extends FormRequest
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
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
        ];
    }

    public function messages(): array
    { 
        return
        [  
            'tgl_awal.required' => 'Tanggal Awal wajib diisi / tidak boleh kosong!',
            'tgl_akhir.required' => 'Tanggal Akhir wajib diisi / tidak boleh kosong!',
            'min' => ':attribute data harus diisi minimal :min karakter!',
            'max' => ':attribute data harus diisi maksimal :max karakter!',
        ]; 
    } 
   
}
