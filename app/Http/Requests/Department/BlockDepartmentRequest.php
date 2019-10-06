<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class BlockDepartmentRequest extends FormRequest
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
            'id_block_department'      => ['required', 'max:20', 'alpha_num'],
            'blocked_block_department' => ['nullable'],
        ];
    }
}
