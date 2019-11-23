<?php

namespace App\Http\Requests\Management\Company;

use Illuminate\Foundation\Http\FormRequest;

class NewAdminCompanyRequest extends FormRequest
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
            'name_new_admin_company'       => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email_new_admin_company'      => ['required', 'max:191', 'email', 'unique:users,email'],
            'id_company_new_admin_company' => ['required', 'max:20', 'alpha_num'],
        ];
    }
}
