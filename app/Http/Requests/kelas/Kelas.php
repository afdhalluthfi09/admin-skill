<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Foundation\Http\FormRequest;

class Kelas extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name'=>'required',
            'slug'=>'required',
            'gambar'=>'required',
            'idhash'=>'required',
            'guru'=>'required',
            'description'=>'required',
            'lokasi'=>'required',
            'harga'=>'required',
            'status'=>'required',
            'jadwal'=>'required',
            'idhash'=>'required',
            'categorise_id'=>'required'
        ];
    }
}
