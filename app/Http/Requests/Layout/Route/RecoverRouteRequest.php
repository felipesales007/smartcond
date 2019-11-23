<?php

namespace App\Http\Requests\Layout\Route;

use Illuminate\Foundation\Http\FormRequest;

class RecoverRouteRequest extends FormRequest
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
            'id_recover_route'                 => ['required', 'max:20', 'alpha_num'],
            'route_recover_route'              => ['required', 'min:3', 'max:191', 'alpha_route'],
            'route_confirmation_recover_route' => ['required', 'min:3', 'max:191', 'alpha_route', 'same:route_recover_route'],
        ];
    }
}
