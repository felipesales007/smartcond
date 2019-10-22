<?php

namespace App\Http\Requests\Entity;

use Illuminate\Foundation\Http\FormRequest;

class NewEntityUserRequest extends FormRequest
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
            'name_new_entity_user'      => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email_new_entity_user'     => ['required', 'max:191', 'email', 'unique:users,email'],
            'id_entity_new_entity_user' => ['required', 'max:20', 'alpha_num'],
        ];
    }
}
