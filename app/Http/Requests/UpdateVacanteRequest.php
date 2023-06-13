<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacanteRequest extends FormRequest
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
            'periodo' => 'required|string|min:1',
            'numPrograma' => 'required|string|min:1',
            'numPlaza' => 'required|string|min:1',
            //'numHoras' => 'required|numeric|min:1',
            'numMateria' => 'required|string|min:1',
            //'nombreMateria' => 'required|string|min:1',
            'grupo' => 'required|string|min:1',
            'subGrupo' => 'required|string|min:1',
            'numMotivo' => 'required|string|min:1',
            'tipoContratacion' => 'required|string|min:1',
            //'tipoAsignacion' => 'required|string|min:1',
            'numPersonalDocente' => 'required|string|min:1',
            'plan' => 'nullable|numeric|min:1',
            'observaciones' => 'nullable|string|min:1',
            //'fechaAsignacion' => 'nullable|string|min:1',
            //'fechaApertura' => 'nullable|string|min:1',
            //'fechaCierre' => 'nullable|string|min:1',
            //'fechaRenuncia' => 'nullable|string|min:1',
        ];
    }

    public function messages()
    {
        return [
            'periodo.required' => 'El periodo es obligatorio',
            'numPrograma.required' => 'El número de programa es obligatorio',
            'numPlaza.required' => 'El número de plaza es obligatorio',
            'numHoras.required' => 'El número de horases obligatorio',
            'numMateria.required' => 'El número de materia es obligatorio',
            //'nombreMateria.required' => 'El nombre de materia es obligatorio',
            'grupo.required' => 'El grupo es obligatorio',
            'subGrupo.required' => 'El sub grupo es obligatorio',
            'numMotivo.required' => 'El motivo es obligatorio',
            'tipoContratacion.required' => 'El tipo de contratación es obligatorio',
            'tipoAsignacion.required' => 'El tipo de asignación es obligatorio',
            'numPersonalDocente.required' => 'El número personal del docente es obligatorio',
            //'' => '',
        ];
    }


}
