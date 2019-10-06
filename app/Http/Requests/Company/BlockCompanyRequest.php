<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class BlockCompanyRequest extends FormRequest
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
            'id_block_company'         => ['required', 'max:20', 'alpha_num'],
            'blocked_block_company'    => ['nullable'],
            'blocked_at_block_company' => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
        ];
    }
}
