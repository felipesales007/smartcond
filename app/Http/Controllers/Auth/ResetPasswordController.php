<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param Request $request
     * @param  string|null  $token
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        auth()->logout();

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

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
