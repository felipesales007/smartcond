<?php

namespace App\Http\Requests\Condominium\Parking;

use App\Models\Entity\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewParkingRequest extends FormRequest
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
            'name_new_condominium_parking'        => ['required', 'max:191', 'alpha_digit_number', Rule::unique('condominium_parkings', 'name')->where('entity_id', Entity::id())],
            'description_new_condominium_parking' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
