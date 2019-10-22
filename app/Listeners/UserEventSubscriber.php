<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Hash;

class UserEventSubscriber
{
    /**
     * Manipule eventos de login do usuário.
     */
    public function onUserLogin()
    {
        // se usuário com o e-mail verificado armazena um token da sessão atual dele
        if (auth()->user()['email_verified_at']) {
            $accessToken = Hash::make(date('YmdHms'));

            $user = auth()->user();
            $user->access_token = $accessToken;
            $user->save();

            session()->put('access_token', $accessToken);
        }
    }

    /**
     * Registre os ouvintes para o assinante.
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        /*
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
        */
    }
}
