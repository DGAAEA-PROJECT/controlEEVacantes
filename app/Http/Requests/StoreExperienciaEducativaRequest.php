<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienciaEducativaRequest extends FormRequest
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
    //https://laravel.com/docs/9.x/validation#form-request-validation
    public function rules()
    {
        return [
            'numMateria'=> 'unique:App\Models\ExperienciaEducativa,numMateria|required|numeric|min:1',
            //'nrc'=> 'unique:App\Models\ExperienciaEducativa,nrc|nullable|numeric|min:1',
            'nombre'=> 'required|string|min:1',
            'horas'=> 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
          'numMateria.required' => 'El número de la Experiencia Educativa es obligatorio',
          'numMateria.unique' => 'El número de materia ingresado ya ha sido registrado',
          //'nrc.unique' => 'El NRC ingresado ya ha sido registrado',
          'nombre.required' => 'El nombre es obligatorio',
          'horas.required' => 'El número de horas es obligatorio',
        ];
    }



}
