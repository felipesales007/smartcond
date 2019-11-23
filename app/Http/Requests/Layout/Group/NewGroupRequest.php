<?php

namespace App\Http\Requests\Layout\Group;

use Illuminate\Foundation\Http\FormRequest;

class NewGroupRequest extends FormRequest
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
            'name_new_group'          => ['required', 'min:3', 'max:191', 'alpha_group', 'unique:groups,name'],
            'user_level_id_new_group' => ['required'],
            'description_new_group'   => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
