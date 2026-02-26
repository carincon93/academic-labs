<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
           return [
               'nombre_ambiente' => 'required|max:128',
               'tipo_ambiente'=>'required',
               'movilidad'=>'required',
               'estado'=>'required',
               'cupo'=>'required|max:4',
           ];
       }
       public function messages()
       {
            return [
               'nombre_ambiente.required'=>'El campo nombre de ambiente es requerido',
               'nombre_ambiente.max'=>'El campo nombre debe tener como máximo 128 caracteres',
               'tipo_ambiente.required'=>'El campo tipo de ambiente es requerido',
               'movilidad.required'=>'El campo movilidad es requerido',
               'estado.required'=>'El campo estado es requerido',
               'cupo.required'=>'El campo cupo es requerido',
               'cupo.max'=>'El campo cupo debe tener como máximo 4 caracteres',
           ];
       }
}
