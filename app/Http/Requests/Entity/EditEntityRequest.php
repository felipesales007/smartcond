<?php

namespace App\Http\Requests\Entity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditEntityRequest extends FormRequest
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
            'id_edit_entity'             => ['required', 'max:20', 'alpha_num'],
            'logo_edit_entity'           => ['nullable'],
            'image_logo_edit_entity'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'cnpj_edit_entity'           => ['required', 'min:18', 'max:18', 'format_cnpj', 'cnpj', Rule::unique('entities', 'cnpj')->ignore($this->id_edit_entity)],
            'name_edit_entity'           => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'corporate_name_edit_entity' => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'email_edit_entity'          => ['nullable', 'max:191', 'email', Rule::unique('entities', 'email')->ignore($this->id_edit_entity)],
            'contact_edit_entity'        => ['nullable', 'min:14', 'max:15', 'phones'],
            'postal_code_edit_entity'    => ['required', 'min:9', 'max:9', 'format_cep'],
            'address_edit_entity'        => ['required', 'min:3', 'max:191'],
            'house_number_edit_entity'   => ['nullable', 'max:191'],
            'complement_edit_entity'     => ['nullable', 'min:3', 'max:191'],
            'neighborhood_edit_entity'   => ['required', 'min:3', 'max:191'],
            'city_edit_entity'           => ['required', 'min:3', 'max:191'],
            'state_id_edit_entity'       => ['required'],
            'country_edit_entity'        => ['required', 'min:3', 'max:191'],
        ];
    }

    /**
     * Obtenha os atributos de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'max' => [
                'file' => 'O campo :attribute não pode ser superior a 1 mb.'
            ],
        ];
    }
}
