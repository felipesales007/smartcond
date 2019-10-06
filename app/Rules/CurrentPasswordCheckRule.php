<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordCheckRule implements Rule
{
    /**
     * Determine se a regra de validação é aprovada.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()['password']);
    }

    /**
     * Receba a mensagem de erro de validação.
     *
     * @return array|string|null
     */
    public function message()
    {
        $message = 'O campo da senha atual não corresponde à sua senha.';
        return __($message);
    }
}
