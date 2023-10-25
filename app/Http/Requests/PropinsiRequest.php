<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PropinsiRequest extends FormRequest
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
            'nm_propinsi'              => 'Nama Propinsi'
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
            'kd_propinsi' => 'required|numeric|max_digits:2|unique:propinsi',
            'nm_propinsi' => 'required|string|max:255',
        ];
    }
}
