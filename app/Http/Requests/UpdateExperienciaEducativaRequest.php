<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExperienciaEducativaRequest extends FormRequest
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
            //'numMateria'=> 'unique:App\Models\ExperienciaEducativa,numMateria|required|numeric|min:1',
            'numMateria' => [
              'required',
              'string',
              'min:1',
              Rule::unique('experiencia_educativas')->ignore($this->route('id')),
            ],
            //'nrc'=> 'unique:App\Models\ExperienciaEducativa,nrc|nullable|numeric|min:1',
            'nrc' => [
                'nullable',
                'numeric',
                'min:1',
                Rule::unique('experiencia_educativas')->ignore($this->route('id')),
            ],
            'nombre'=> 'required|string|min:1',
            'horas'=> 'required|string|min:1',
        ];
    }

    public function messages()
    {
        return [
          'numMateria.required' => 'El número de la Experiencia Educativa es obligatorio',
          'numMateria.unique' => 'El número de materia ingresado ya ha sido registrado',
          'nrc.unique' => 'El NRC ingresado ya ha sido registrado',
          'nombre.required' => 'El nombre es obligatorio',
          'horas.required' => 'El número de horas es obligatorio',
        ];
    }

}
