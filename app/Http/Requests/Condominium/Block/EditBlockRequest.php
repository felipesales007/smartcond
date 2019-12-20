<?php

namespace App\Http\Requests\Condominium\Block;

use Illuminate\Foundation\Http\FormRequest;

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
            'id_edit_block'          => ['required', 'max:20', 'alpha_num'],
            'name_edit_block'        => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'description_edit_block' => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
