<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassGroupRequest extends FormRequest
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
    * @return array
    */
    public function rules()
    {
        if ($this->isMethod('put')) {
            return [
                'id_ficha' => 'required|max:8|unique:class_groups,id,:id',
                'nombre_ficha'=>'required|max:100',
                'tipo_formacion'=>'required',
            ];
        } else {
            return [
                'id_ficha' => 'required|max:8|unique:class_groups',
                'nombre_ficha'=>'required|max:100',
                'tipo_formacion'=>'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'id_ficha.required'=>'El campo ID de ficha es requerido',
            'id_ficha.max'=>'El campo ID de ficha debe tener como máximo 8 caracteres',
            'id_ficha.unique'=>'Este número de ficha ya existe',
            'nombre_ficha.required'=>'El campo nombre de ficha es requerido',
            'nombre_ficha.max'=>'El campo nombre de ficha debe tener como máximo 100 caracteres',
            'instructor_id.required'=>'El campo instructor es requerido',

            'tipo_formacion.required'=>'El campo tipo de formacion es requerido',
        ];
    }
}
