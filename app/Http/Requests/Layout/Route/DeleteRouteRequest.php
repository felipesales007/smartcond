<?php

namespace App\Http\Requests\Layout\Route;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRouteRequest extends FormRequest
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
            'id_delete_route'                 => ['required', 'max:20', 'alpha_num'],
            'route_delete_route'              => ['required', 'min:3', 'max:191', 'alpha_route'],
            'route_confirmation_delete_route' => ['required', 'min:3', 'max:191', 'alpha_route', 'same:route_delete_route'],
        ];
    }
}
