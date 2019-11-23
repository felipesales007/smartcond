<?php

namespace App\Http\Requests\Management\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditAdminRequest extends FormRequest
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
            'id_edit_admin'                    => ['required', 'max:20', 'alpha_num'],
            'name_edit_admin'                  => ['required', 'min:3', 'max:191', 'alpha_space'],
            'cpf_edit_admin'                   => ['nullable', 'min:14', 'max:14', 'format_cpf', 'cpf', Rule::unique('users', 'cpf')->ignore($this->id_edit_admin)],
            'rg_edit_admin'                    => ['nullable', 'min:8', 'max:14', 'alpha_num', Rule::unique('users', 'rg')->ignore($this->id_edit_admin)],
            'email_edit_admin'                 => ['required', 'max:191', 'email', Rule::unique('users', 'email')->ignore($this->id_edit_admin)],
            'company_id_edit_admin'            => ['required'],
            'password_edit_admin'              => ['nullable', 'min:8', 'max:191', 'same:password_confirmation_edit_admin'],
            'password_confirmation_edit_admin' => ['nullable', 'min:8', 'max:191'],
            'birthday_edit_admin'              => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'contact_edit_admin'               => ['nullable', 'min:14', 'max:15', 'phones'],
            'gender_id_edit_admin'             => ['nullable'],
            'description_edit_admin'           => ['nullable', 'min:10', 'max:1500'],
            'course_edit_admin'                => ['nullable', 'min:3', 'max:191'],
            'college_edit_admin'               => ['nullable', 'min:3', 'max:191'],
            'profession_edit_admin'            => ['nullable', 'min:3', 'max:191'],
            'company_edit_admin'               => ['nullable', 'min:3', 'max:191'],
            'postal_code_edit_admin'           => ['nullable', 'min:9', 'max:9', 'format_cep'],
            'address_edit_admin'               => ['nullable', 'min:3', 'max:191'],
            'house_number_edit_admin'          => ['nullable', 'max:191'],
            'complement_edit_admin'            => ['nullable', 'min:3', 'max:191'],
            'neighborhood_edit_admin'          => ['nullable', 'min:3', 'max:191'],
            'city_edit_admin'                  => ['nullable', 'min:3', 'max:191'],
            'state_id_edit_admin'              => ['nullable'],
            'country_edit_admin'               => ['nullable', 'min:3', 'max:191'],
            'photo_edit_admin'                 => ['nullable'],
            'background_edit_admin'            => ['nullable'],
            'image_photo_edit_admin'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'image_background_edit_admin'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
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
