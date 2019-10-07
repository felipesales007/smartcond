<?php

namespace App\Http\Requests\Inventory\InventoryCategory;

use Illuminate\Foundation\Http\FormRequest;

class NewInventoryCategoryRequest extends FormRequest
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
            'name_new_category'        => ['required', 'min:3', 'max:191', 'alpha_digit', 'unique:inventory_categories,name'],
            'description_new_category' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
