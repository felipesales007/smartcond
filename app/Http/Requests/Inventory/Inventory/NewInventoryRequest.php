<?php

namespace App\Http\Requests\Inventory\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class NewInventoryRequest extends FormRequest
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
            'department_id_new_inventory'         => ['required'],
            'inventory_category_id_new_inventory' => ['required'],
            'inventory_state_id_new_inventory'    => ['required'],
            'patrimonial_number_new_inventory'    => ['nullable', 'max:191', 'alpha_num'],
            'name_new_inventory'                  => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'brand_new_inventory'                 => ['nullable', 'min:3', 'max:191', 'alpha_digit'],
            'model_new_inventory'                 => ['nullable', 'max:191'],
            'serial_number_new_inventory'         => ['nullable', 'max:191'],
            'invoice_new_inventory'               => ['nullable', 'max:191'],
            'value_new_inventory'                 => ['nullable', 'max:191', 'decimal'],
            'voltage_id_new_inventory'            => ['required'],
            'purchase_date_new_inventory'         => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'warranty_date_new_inventory'         => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'description_new_inventory'           => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
