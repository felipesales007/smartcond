<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Canais de transmissão
|--------------------------------------------------------------------------
|
| Aqui você pode registrar todos os canais de transmissão de eventos que seu
| suporte de aplicativos. Os retornos de chamada de autorização do canal
| usado para verificar se um usuário autenticado pode ouvir o canal.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
