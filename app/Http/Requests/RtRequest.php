<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    public function attributes()
    {
        return [
            'kd_propinsi'             => 'Kode Propinsi',
            'kd_dati2'             => 'Kode Kabupaten',
            'kd_kecamatan'             => 'Kode Kecamatan',
            'kd_kelurahan'             => 'Kode Kelurahan',
            'kd_rt'             => 'Kode RT',
            'nm_rt'              => 'Nama RT'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kd_propinsi' => 'required|numeric|max_digits:2',
            'kd_dati2' => 'required|numeric|max_digits:2',
            'kd_kecamatan' => 'required|numeric|max_digits:3',
            'kd_kelurahan' => 'required|numeric|max_digits:3',
            'kd_rt' => 'required|numeric|max_digits:3',
            'nm_rt' => 'required|string|max:255',
        ];
    }
}
