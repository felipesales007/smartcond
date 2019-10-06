<?php

namespace App\Http\Requests\Route\Route;

use Illuminate\Foundation\Http\FormRequest;

class NewRouteRequest extends FormRequest
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
            'group_id_new_route'        => ['required'],
            'route_option_id_new_route' => ['required'],
            'view_new_route'            => ['nullable'],
            'url_new_route'             => ['required', 'min:3', 'max:191', 'alpha_url'],
            'route_new_route'           => ['required', 'min:3', 'max:191', 'alpha_route', 'unique:routes,route'],
            'controller_new_route'      => ['required', 'min:3', 'max:191', 'alpha_controller', 'format_controller'],
            'description_new_route'     => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
