<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PartidaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer este request
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Obtiene las reglas de validación para este request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        //Título requerido, máximo 32 caracteres
        //Slug máximo 36 caracteres (no requerido porque se generaría solo)
        //Entradilla máximo 128 caracteres (no requerida)
        $rules = [
            'usuario' => 'required|max:32',
            'slug' => 'max:36',
            'puntos' => 'max:36',
        ];

        return $rules;

    }
}
