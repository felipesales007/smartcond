<?php

namespace App\Http\Requests\Route\Group;

use Illuminate\Foundation\Http\FormRequest;

class RecoverGroupRequest extends FormRequest
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
            'id_recover_group'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_group'              => ['required', 'min:3', 'max:191', 'alpha_group'],
            'name_confirmation_recover_group' => ['required', 'min:3', 'max:191', 'alpha_group', 'same:name_recover_group'],
        ];
    }
}
