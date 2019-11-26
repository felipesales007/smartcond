<?php

namespace App\Http\Requests\Inventory\InventoryCategory;

use App\Models\Entity\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name_new_inventory_category'        => ['required', 'min:3', 'max:191', 'alpha_digit', Rule::unique('inventory_categories', 'name')->where('entity_id', Entity::id())],
            'description_new_inventory_category' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
