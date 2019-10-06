<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
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
            'id_delete_user'                => ['required', 'max:20', 'alpha_num'],
            'name_delete_user'              => ['required', 'min:3', 'max:191', 'alpha'],
            'name_confirmation_delete_user' => ['required', 'min:3', 'max:191', 'alpha', 'same:name_delete_user'],
        ];
    }
}
