<?php

namespace App\Http\Requests\Layout\Menu;

use Illuminate\Foundation\Http\FormRequest;

class RecoverMenuRequest extends FormRequest
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
            'id_recover_menu'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_menu'              => ['required', 'min:3', 'max:191', 'alpha_space'],
            'name_confirmation_recover_menu' => ['required', 'min:3', 'max:191', 'alpha_space', 'same:name_recover_menu'],
        ];
    }
}
