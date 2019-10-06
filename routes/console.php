<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Rotas do console
|--------------------------------------------------------------------------
|
| Este arquivo é onde você pode definir toda o seu console baseado em Closure
| comandos. Cada Closure está ligado a uma instância de comando, permitindo
| abordagem simples para interagir com os métodos de IO de cada comando.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
