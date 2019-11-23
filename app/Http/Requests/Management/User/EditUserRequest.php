<?php

namespace App\Http\Requests\Management\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
            'id_edit_user'                    => ['required', 'max:20', 'alpha_num'],
            'name_edit_user'                  => ['required', 'min:3', 'max:191', 'alpha_space'],
            'cpf_edit_user'                   => ['nullable', 'min:14', 'max:14', 'format_cpf', 'cpf', Rule::unique('users', 'cpf')->ignore($this->id_edit_user)],
            'rg_edit_user'                    => ['nullable', 'min:8', 'max:14', 'alpha_num', Rule::unique('users', 'rg')->ignore($this->id_edit_user)],
            'email_edit_user'                 => ['required', 'max:191', 'email', Rule::unique('users', 'email')->ignore($this->id_edit_user)],
            'entity_id_edit_user'             => ['required'],
            'password_edit_user'              => ['nullable', 'min:8', 'max:191', 'same:password_confirmation_edit_user'],
            'password_confirmation_edit_user' => ['nullable', 'min:8', 'max:191'],
            'birthday_edit_user'              => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'contact_edit_user'               => ['nullable', 'min:14', 'max:15', 'phones'],
            'gender_id_edit_user'             => ['nullable'],
            'description_edit_user'           => ['nullable', 'min:10', 'max:1500'],
            'course_edit_user'                => ['nullable', 'min:3', 'max:191'],
            'college_edit_user'               => ['nullable', 'min:3', 'max:191'],
            'profession_edit_user'            => ['nullable', 'min:3', 'max:191'],
            'company_edit_user'               => ['nullable', 'min:3', 'max:191'],
            'postal_code_edit_user'           => ['nullable', 'min:9', 'max:9', 'format_cep'],
            'address_edit_user'               => ['nullable', 'min:3', 'max:191'],
            'house_number_edit_user'          => ['nullable', 'max:191'],
            'complement_edit_user'            => ['nullable', 'min:3', 'max:191'],
            'neighborhood_edit_user'          => ['nullable', 'min:3', 'max:191'],
            'city_edit_user'                  => ['nullable', 'min:3', 'max:191'],
            'state_id_edit_user'              => ['nullable'],
            'country_edit_user'               => ['nullable', 'min:3', 'max:191'],
            'photo_edit_user'                 => ['nullable'],
            'background_edit_user'            => ['nullable'],
            'image_photo_edit_user'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'image_background_edit_user'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
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
