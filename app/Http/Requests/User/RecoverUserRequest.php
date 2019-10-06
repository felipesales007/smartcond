<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RecoverUserRequest extends FormRequest
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
            'id_recover_user'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_user'              => ['required', 'min:3', 'max:191', 'alpha'],
            'name_confirmation_recover_user' => ['required', 'min:3', 'max:191', 'alpha', 'same:name_recover_user'],
        ];
    }
}
