<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de redefinição de senha
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável por lidar com solicitações de redefinição de senha
    | e usa uma característica simples para incluir esse comportamento. Você é livre para
    | explore essa característica e substitua os métodos que você deseja ajustar.
    |
    */

    use ResetsPasswords;

    /**
     * Para onde redirecionar os usuários depois de redefinir sua senha.
     *
     * @var string
     */
    protected $redirectTo = '/home/index';

    /**
     * @param $user
     * @param $password
     */
    protected function resetPassword($user, $password)
    {
        if ($user->email_verified_at) {
            $user->forceFill([
                'password'       => Hash::make($password),
                'remember_token' => Str::random(60),
                'last_login_at'  => now()->toDateTimeString(),
                'last_login_ip'  => request()->ip()
            ])->save();
        } else {
            $user->forceFill([
                'password'          => Hash::make($password),
                'email_verified_at' => now()->toDateTimeString(),
                'remember_token'    => Str::random(60),
                'last_login_at'     => now()->toDateTimeString(),
                'last_login_ip'     => request()->ip()
            ])->save();
        }

        $this->guard()->login($user);
    }
}
