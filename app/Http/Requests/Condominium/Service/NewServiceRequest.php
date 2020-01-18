<?php

namespace App\Http\Requests\Condominium\Service;

use App\Models\Entity\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewServiceRequest extends FormRequest
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
            'name_new_condominium_service'       => ['required', 'min:3', 'max:191', 'alpha_space', Rule::unique('condominium_services', 'name')->where('entity_id', Entity::id())],
            'rg_new_condominium_service'         => ['nullable', 'min:8', 'max:14', 'alpha_num', Rule::unique('condominium_services', 'rg')],
            'contact_new_condominium_service'    => ['nullable', 'min:14', 'max:15', 'phones'],
            'profession_new_condominium_service' => ['nullable', 'min:3', 'max:191'],
            'note_new_condominium_service'       => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
