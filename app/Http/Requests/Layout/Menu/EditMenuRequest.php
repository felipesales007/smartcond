<?php

namespace App\Http\Requests\Layout\Menu;

use Illuminate\Foundation\Http\FormRequest;

class EditMenuRequest extends FormRequest
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
            'id_edit_menu'             => ['required', 'max:20', 'alpha_num'],
            'name_edit_menu'           => ['required', 'min:3', 'max:191', 'alpha_space'],
            'menu_option_id_edit_menu' => ['required'],
            'icon_edit_menu'           => ['required', 'min:3', 'max:191', 'alpha_icon'],
            'color_id_edit_menu'       => ['required'],
            'order_edit_menu'          => ['required', 'max:10', 'alpha_num'],
            'hidden_edit_menu'         => ['nullable'],
            'description_edit_route'   => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
