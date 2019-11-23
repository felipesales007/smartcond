<?php

namespace App\Http\Requests\Layout\Group;

use Illuminate\Foundation\Http\FormRequest;

class BlockGroupRequest extends FormRequest
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
            'id_block_group'      => ['required', 'max:20', 'alpha_num'],
            'blocked_block_group' => ['nullable'],
        ];
    }
}
