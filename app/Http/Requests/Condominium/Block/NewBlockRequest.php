<?php

namespace App\Http\Requests\Condominium\Block;

use Illuminate\Foundation\Http\FormRequest;

class NewBlockRequest extends FormRequest
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
            'name_new_condominium_block'        => ['required', 'max:191', 'alpha_digit_number'],
            'description_new_condominium_block' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
