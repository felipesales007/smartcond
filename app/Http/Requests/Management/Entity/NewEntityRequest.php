<?php

namespace App\Http\Requests\Management\Entity;

use Illuminate\Foundation\Http\FormRequest;

class NewEntityRequest extends FormRequest
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
            'logo_new_entity'           => ['nullable'],
            'image_logo_new_entity'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'cnpj_new_entity'           => ['required', 'min:18', 'max:18', 'format_cnpj', 'cnpj', 'unique:entities,cnpj'],
            'name_new_entity'           => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'corporate_name_new_entity' => ['required', 'min:3', 'max:191', 'alpha_digit'],
            'email_new_entity'          => ['nullable', 'max:191', 'email', 'unique:entities,email'],
            'contact_new_entity'        => ['nullable', 'min:14', 'max:15', 'phones'],
            'postal_code_new_entity'    => ['required', 'min:9', 'max:9', 'format_cep'],
            'address_new_entity'        => ['required', 'min:3', 'max:191'],
            'house_number_new_entity'   => ['nullable', 'max:191'],
            'complement_new_entity'     => ['nullable', 'min:3', 'max:191'],
            'neighborhood_new_entity'   => ['required', 'min:3', 'max:191'],
            'city_new_entity'           => ['required', 'min:3', 'max:191'],
            'state_id_new_entity'       => ['required'],
            'country_new_entity'        => ['required', 'min:3', 'max:191'],
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
