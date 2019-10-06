<?php

namespace App\Http\Requests\Permission;

use App\Helpers\NotifyHelpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class EditPermissionRequest extends FormRequest
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
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'Erro ao tentar atualizar a permissão do usuário, por favor tente novamente.');

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
            'id_edit_user_permission' => ['required', 'max:20', 'alpha_num'],
        ];
    }
}
