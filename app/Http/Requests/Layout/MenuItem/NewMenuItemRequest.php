<?php

namespace App\Http\Requests\Layout\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class NewMenuItemRequest extends FormRequest
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
            'menu_id_new_menu_item'     => ['required'],
            'route_id_new_menu_item'    => ['required'],
            'name_new_menu_item'        => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'order_new_menu_item'       => ['required', 'max:10', 'alpha_num'],
            'button_new_menu_item'      => ['nullable', 'min:3', 'max:191', 'alpha_group'],
            'main_new_menu_item'        => ['nullable'],
            'hidden_new_menu_item'      => ['nullable'],
            'description_new_menu_item' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
