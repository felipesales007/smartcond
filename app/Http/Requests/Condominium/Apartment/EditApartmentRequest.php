<?php

namespace App\Http\Requests\Condominium\Apartment;

use App\Models\Entity\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditApartmentRequest extends FormRequest
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
            'id_edit_condominium_apartment'          => ['required', 'max:20', 'alpha_num'],
            'block_id_edit_condominium_apartment'    => ['required'],
            'name_edit_condominium_apartment'        => ['required', 'max:191', 'alpha_digit_number', Rule::unique('condominium_apartments', 'name')->where('entity_id', Entity::id())->where('block_id', $this->block_id_edit_condominium_apartment)->ignore($this->id_edit_apartment_block)],
            'description_edit_condominium_apartment' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
