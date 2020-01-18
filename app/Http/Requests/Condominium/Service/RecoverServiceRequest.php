<?php

namespace App\Http\Requests\Condominium\Service;

use Illuminate\Foundation\Http\FormRequest;

class RecoverServiceRequest extends FormRequest
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
            'id_recover_condominium_service'                => ['required', 'max:20', 'alpha_num'],
            'name_recover_condominium_service'              => ['required', 'max:191', 'alpha_digit_number'],
            'name_confirmation_recover_condominium_service' => ['required', 'max:191', 'alpha_digit_number', 'same:name_recover_condominium_service'],
        ];
    }
}
