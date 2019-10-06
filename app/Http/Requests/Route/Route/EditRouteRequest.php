<?php

namespace App\Http\Requests\Route\Route;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRouteRequest extends FormRequest
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
            'id_edit_route'              => ['required', 'max:20', 'alpha_num'],
            'group_id_edit_route'        => ['required'],
            'route_option_id_edit_route' => ['required'],
            'view_edit_route'            => ['nullable'],
            'url_edit_route'             => ['required', 'min:3', 'max:191', 'alpha_url'],
            'route_edit_route'           => ['required', 'min:3', 'max:191', 'alpha_route', Rule::unique('routes', 'route')->ignore($this->id_edit_route)],
            'controller_edit_route'      => ['required', 'min:3', 'max:191', 'alpha_controller', 'format_controller'],
            'description_edit_route'     => ['nullable', 'min:10', 'max:1500'],
        ];
    }
}
