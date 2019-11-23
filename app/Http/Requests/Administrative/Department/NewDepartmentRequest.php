<?php

namespace App\Http\Requests\Administrative\Department;

use Illuminate\Foundation\Http\FormRequest;

class NewDepartmentRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer essa solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_new_department'        => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'description_new_department' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
