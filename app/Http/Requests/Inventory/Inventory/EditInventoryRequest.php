<?php

namespace App\Http\Requests\Inventory\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditInventoryRequest extends FormRequest
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
            'image_edit_inventory'                 => ['nullable'],
            'image_image_edit_inventory'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'department_id_edit_inventory'         => ['required'],
            'inventory_category_id_edit_inventory' => ['required'],
            'inventory_state_id_edit_inventory'    => ['required'],
            'patrimonial_number_edit_inventory'    => ['nullable', 'max:191', 'alpha_num'],
            'name_edit_inventory'                  => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'brand_edit_inventory'                 => ['nullable', 'min:3', 'max:191', 'alpha_digit'],
            'model_edit_inventory'                 => ['nullable', 'max:191'],
            'serial_number_edit_inventory'         => ['nullable', 'max:191'],
            'invoice_edit_inventory'               => ['nullable', 'max:191'],
            'value_edit_inventory'                 => ['nullable', 'max:191', 'decimal'],
            'voltage_id_edit_inventory'            => ['required'],
            'purchase_date_edit_inventory'         => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'warranty_date_edit_inventory'         => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'description_edit_inventory'           => ['nullable', 'min:10', 'max:1500'],
        ];
    }

    /**
     * Obtenha os atributos de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'max' => [
                'file' => 'O campo :attribute não pode ser superior a 1 mb.'
            ],
        ];
    }
}
