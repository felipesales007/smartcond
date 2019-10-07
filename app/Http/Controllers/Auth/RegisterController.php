<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyAccesses;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de registro
    |--------------------------------------------------------------------------
    |
    | Este controlador lida com o registro de novos usuários e seus
    | validação e criação. Por padrão, este controlador usa uma característica para
    | forneça essa funcionalidade sem exigir nenhum código adicional.
    |
    */

    use RegistersUsers;

    /**
     * Para onde redirecionar os usuários após o registro.
     *
     * @var string
     */
    protected $redirectTo = '/home/index';

    /**
     * Construtor RegisterController.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Obtenha um validador para uma solicitação de registro recebida.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                  => ['required', 'min:3', 'max:191', 'alpha_space'],
            'email'                 => ['required', 'email', 'max:191', 'unique:users'],
            'password'              => ['required', 'min:8', 'max:191', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'max:191',],
            'g-recaptcha-response'  => ['required', 'recaptcha'],
        ]);
    }

    /**
     * Crie uma nova instância de usuário após um registro válido.
     *
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
//        $user = User::create([
//            'name'           => $data['name'],
//            'email'          => $data['email'],
//            'password'       => Hash::make($data['password']),
//            'last_update_at' => now()
//        ]);
//
//        Permission::create([
//            'user_id'  => $user->id,
//            'route_id' => '1'
//        ]);
//
//        CompanyAccesses::create([
//            'company_id' => '1',
//            'user_id'    => $user->id,
//            'preferred'  => '1'
//        ]);
//
//        for ($i = 2; $i <= 110; $i++) {
//            Permission::create([
//                'user_id'    => $user->id,
//                'route_id'   => $i,
//                'created_at' => now(),
//                'updated_at' => now()
//            ]);
//        }
//
//        return $user;
    }
}
