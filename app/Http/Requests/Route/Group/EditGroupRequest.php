<?php

namespace App\Http\Requests\Route\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditGroupRequest extends FormRequest
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
            'id_edit_group'          => ['required', 'max:20', 'alpha_num'],
            'name_edit_group'        => ['required', 'min:3', 'max:191', 'alpha_group', Rule::unique('groups', 'name')->ignore($this->id_edit_group)],
            'description_edit_group' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
