<?php

namespace App\Http\Requests\Entity;

use Illuminate\Foundation\Http\FormRequest;

class RecoverEntityRequest extends FormRequest
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
            'id_recover_entity'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_entity'              => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'name_confirmation_recover_entity' => ['required', 'min:3', 'max:191', 'alpha_digit', 'same:name_recover_entity'],
        ];
    }
}
