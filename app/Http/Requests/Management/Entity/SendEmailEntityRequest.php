<?php

namespace App\Http\Requests\Management\Entity;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailEntityRequest extends FormRequest
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
            'name_send_email_entity'    => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email_send_email_entity'   => ['required', 'max:191', 'email'],
            'message_send_email_entity' => ['required', 'min:10', 'max:1500'],
        ];
    }
}
