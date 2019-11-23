<?php

namespace App\Http\Requests\Management\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewAdminRequest extends FormRequest
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
            'name_new_admin'                     => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email_new_admin'                    => ['required', 'max:191', 'email', 'unique:users,email'],
            'company_id_new_admin'               => ['required'],
        ];
    }
}
