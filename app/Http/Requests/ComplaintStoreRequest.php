<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Ubah menjadi true jika tidak ada pembatasan akses
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'rent_id' => 'required|exists:rents,id',
            'keluhan' => 'required|string',
            'gambar_keluhan' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'Nama User wajib diisi.',
            'user_id.exists' => 'Nama User tidak ditemukan dalam database.',
            'rent_id.required' => 'Nama Kontrakan wajib diisi.',
            'rent_id.exists' => 'Nama Kontrakan tidak ditemukan dalam database.',
            'keluhan.required' => 'Keluhan wajib diisi.',
            'keluhan.string' => 'Keluhan harus berupa teks.',
            'gambar_keluhan.image' => 'Gambar keluhan harus berupa file gambar.',
            'gambar_keluhan.max' => 'Gambar keluhan tidak boleh lebih besar dari 2048 kilobyte.',
        ];
    }
}
