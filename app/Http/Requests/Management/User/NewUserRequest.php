<?php

namespace App\Http\Requests\Management\User;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
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
            'name_new_user'      => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email_new_user'     => ['required', 'max:191', 'email', 'unique:users,email'],
            'entity_id_new_user' => ['required'],
        ];
    }
}
