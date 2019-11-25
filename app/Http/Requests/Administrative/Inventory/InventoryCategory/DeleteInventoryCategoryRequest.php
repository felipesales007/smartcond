<?php

namespace App\Http\Requests\Inventory\InventoryCategory;

use Illuminate\Foundation\Http\FormRequest;

class DeleteInventoryCategoryRequest extends FormRequest
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
            'id_delete_inventory_category'                => ['required', 'max:20', 'alpha_num'],
            'name_delete_inventory_category'              => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'name_confirmation_delete_inventory_category' => ['required', 'min:3', 'max:191', 'alpha_digit', 'same:name_delete_inventory_category'],
        ];
    }
}
