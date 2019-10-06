<?php

namespace App\Http\Requests\Menu\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class EditMenuItemRequest extends FormRequest
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
            'id_edit_menu_item'          => ['required', 'max:20', 'alpha_num'],
            'menu_id_edit_menu_item'     => ['required'],
            'route_id_edit_menu_item'    => ['required'],
            'name_edit_menu_item'        => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'order_edit_menu_item'       => ['required', 'max:10', 'alpha_num'],
            'button_edit_menu_item'      => ['nullable', 'min:3', 'max:191', 'alpha_group'],
            'list_edit_menu_item'        => ['nullable'],
            'hidden_edit_menu_item'      => ['nullable'],
            'description_edit_menu_item' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
