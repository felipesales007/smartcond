<?php

namespace App\Http\Requests\Layout\Menu;

use Illuminate\Foundation\Http\FormRequest;

class NewMenuRequest extends FormRequest
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
            'name_new_menu'           => ['required', 'min:3', 'max:191', 'alpha_space'],
            'menu_option_id_new_menu' => ['required'],
            'icon_new_menu'           => ['required', 'min:3', 'max:191', 'alpha_icon'],
            'color_id_new_menu'       => ['required'],
            'order_new_menu'          => ['required', 'max:10', 'alpha_num'],
            'hidden_new_menu'         => ['nullable'],
            'description_new_route'   => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
