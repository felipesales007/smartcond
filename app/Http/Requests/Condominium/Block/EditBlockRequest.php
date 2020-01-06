<?php

namespace App\Http\Requests\Condominium\Block;

use App\Models\Entity\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBlockRequest extends FormRequest
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
            'id_edit_condominium_block'          => ['required', 'max:20', 'alpha_num'],
            'name_edit_condominium_block'        => ['required', 'max:191', 'alpha_digit_number', Rule::unique('condominium_blocks', 'name')->where('entity_id', Entity::id())->ignore($this->id_edit_condominium_block)],
            'description_edit_condominium_block' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
