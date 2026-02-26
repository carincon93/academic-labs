<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
       if ($this->method() == 'PUT') {
           return [
              'nombre'=>'required|max:64',
              'apellidos'=>'required|max:64',
              'vinculacion1'=>'required',
              'area'=>'required|max:128',
              'numero_documento'=>'required|max:10|unique:instructors,id,:id',
              'ip'=>'max:5',
              'celular'=>'required|max:10',
              'email'=>'required|unique:instructors,id,:id',
           ];
       }
       else {
           return [
              'nombre'=>'required|max:64',
              'apellidos'=>'required|max:64',
              'vinculacion1'=>'required',
              'area'=>'required|max:128',
              'numero_documento'=>'required|max:10|unique:instructors',
              'ip'=>'max:5',
              'celular'=>'required|max:10',
              'email'=>'required|unique:instructors',
           ];
       }
   }
   public function messages()
   {
        return [
           'nombre.required'=>'El campo nombre es requerido',
           'nombre.max'=>'El campo nombre debe tener como máximo 64 caracteres',
           'apellidos.required'=>'El campo apellidos es requerido',
           'apellidos.max'=>'El campo apellidos debe tener como máximo 64 caracteres',
           'vinculacion1.required'=>'El campo tipo de contrato es requerido',
           'area.required'=>'El campo área es requerido',
           'area.max'=>'El campo área debe tener como máximo 128 caracteres',
           'numero_documento.required'=>'El campo documento es requerido',
           'numero_documento.max'=>'El campo documento debe tener como máximo 10 números',
           'numero_documento.unique'=>'Este número de documento ya existe',
           'ip.max'=>'El campo IP debe tener como máximo 5 números',
           'celular.required'=>'El campo celular es requerido',
           'celular.max'=>'El campo celular debe tener como máximo 10 números',
           'email.required'=>'El campo correo electrónico es requerido',
           'email.unique'=>'Este correo electrónico ya existe',
       ];
   }
}
