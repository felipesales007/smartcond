<?php

namespace App\Http\Requests\Condominium\Parking;

use Illuminate\Foundation\Http\FormRequest;

class RecoverParkingRequest extends FormRequest
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
            'id_recover_condominium_parking'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_condominium_parking'              => ['required', 'max:191', 'alpha_digit_number'],
            'name_confirmation_recover_condominium_parking' => ['required', 'max:191', 'alpha_digit_number', 'same:name_recover_condominium_parking'],
        ];
    }
}
