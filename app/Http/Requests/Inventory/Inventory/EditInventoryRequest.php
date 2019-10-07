<?php

namespace App\Http\Requests\Inventory\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditInventoryRequest extends FormRequest
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
            'id_edit_department'          => ['required', 'max:20', 'alpha_num'],
            'name_edit_department'        => ['required', 'min:3', 'max:191', 'alpha_digit', Rule::unique('departments', 'name')->ignore($this->id_edit_department)],
            'description_edit_department' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
