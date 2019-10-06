<?php

namespace App\Http\Requests\Profile;

use App\Helpers\NotifyHelpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer essa solicitação.
     *
     * @return bool|RedirectResponse
     */
    public function authorize()
    {
        if (auth()->check()) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'Erro ao tentar atualizar o perfil, por favor tente novamente.');

            return back()->with('notify', json_encode($data));
        } else {
            return auth()->check();
        }
    }

    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_edit_profile'           => ['required', 'max:20', 'alpha_num'],
            'name_edit_profile'         => ['required', 'min:3', 'max:191', 'alpha_space'],
            'cpf_edit_profile'          => ['nullable', 'min:14', 'max:14', 'format_cpf', 'cpf', Rule::unique('users', 'cpf')->ignore(auth()->id())],
            'rg_edit_profile'           => ['nullable', 'min:8', 'max:14', 'alpha_num', Rule::unique('users', 'rg')->ignore(auth()->id())],
            'email_edit_profile'        => ['required', 'max:191', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'birthday_edit_profile'     => ['nullable', 'min:10', 'max:10', 'date_format:d/m/Y'],
            'contact_edit_profile'      => ['nullable', 'min:14', 'max:15', 'phones'],
            'gender_id_edit_profile'    => ['nullable'],
            'description_edit_profile'  => ['nullable', 'min:10', 'max:1500'],
            'course_edit_profile'       => ['nullable', 'min:3', 'max:191'],
            'college_edit_profile'      => ['nullable', 'min:3', 'max:191'],
            'profession_edit_profile'   => ['nullable', 'min:3', 'max:191'],
            'company_edit_profile'      => ['nullable', 'min:3', 'max:191'],
            'postal_code_edit_profile'  => ['nullable', 'min:9', 'max:9', 'format_cep'],
            'address_edit_profile'      => ['nullable', 'min:3', 'max:191'],
            'house_number_edit_profile' => ['nullable', 'max:191'],
            'complement_edit_profile'   => ['nullable', 'min:3', 'max:191'],
            'neighborhood_edit_profile' => ['nullable', 'min:3', 'max:191'],
            'city_edit_profile'         => ['nullable', 'min:3', 'max:191'],
            'state_id_edit_profile'     => ['nullable'],
            'country_edit_profile'      => ['nullable', 'min:3', 'max:191'],
            'photo_edit_profile'        => ['nullable'],
            'background_edit_profile'   => ['nullable'],
            'image_0'                   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:6144'],
            'image_1'                   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:6144'],
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
                'file' => 'O campo :attribute não pode ser superior a 6 mb.'
            ],
        ];
    }
}
