<?php

namespace App\Http\Requests\Management\User;

use Illuminate\Foundation\Http\FormRequest;

class ResendEmailUserRequest extends FormRequest
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
            'id_resend_email_user' => ['required', 'max:20', 'alpha_num'],
        ];
    }
}
