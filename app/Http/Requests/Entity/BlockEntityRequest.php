<?php

namespace App\Http\Requests\Entity;

use Illuminate\Foundation\Http\FormRequest;

class BlockEntityRequest extends FormRequest
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
            'id_block_entity'         => ['required', 'max:20', 'alpha_num'],
            'blocked_block_entity'    => ['nullable'],
            'blocked_at_block_entity' => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
        ];
    }
}
