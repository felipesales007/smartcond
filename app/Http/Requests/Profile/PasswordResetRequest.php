<?php

namespace App\Http\Requests\Profile;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'old_password_reset_profile'          => ['required', 'min:8', 'max:191', new CurrentPasswordCheckRule],
            'password_reset_profile'              => ['required', 'min:8', 'max:191', 'same:password_confirmation_reset_profile', 'different:old_password_reset_profile'],
            'password_confirmation_reset_profile' => ['required', 'min:8', 'max:191'],
        ];
    }
}
