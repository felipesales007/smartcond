<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre todos os serviços de aplicativos.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Inicialize todos os serviços de aplicativos.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setlocale(LC_ALL, 'pt_BR');

        // validações
        Validator::extend('alpha_space', '\App\Utils\Validator@alphaSpace');
        Validator::extend('alpha_digit', '\App\Utils\Validator@alphaDigit');
        Validator::extend('alpha_group', '\App\Utils\Validator@alphaGroup');
        Validator::extend('alpha_url', '\App\Utils\Validator@alphaUrl');
        Validator::extend('alpha_route', '\App\Utils\Validator@alphaRoute');
        Validator::extend('alpha_controller', '\App\Utils\Validator@alphaController');
        Validator::extend('alpha_icon', '\App\Utils\Validator@alphaIcon');
        Validator::extend('format_cpf', '\App\Utils\Validator@formatCpf');
        Validator::extend('format_cnpj', '\App\Utils\Validator@formatCnpj');
        Validator::extend('format_cpf_cnpj', '\App\Utils\Validator@formatCpfCnpj');
        Validator::extend('format_nis', '\App\Utils\Validator@formatNis');
        Validator::extend('format_cep', '\App\Utils\Validator@formatCep');
        Validator::extend('format_controller', '\App\Utils\Validator@formatController');
        Validator::extend('phones', '\App\Utils\Validator@phones');
        Validator::extend('cpf', '\App\Utils\Validator@cpf');
        Validator::extend('cnpj', '\App\Utils\Validator@cnpj');
        Validator::extend('cpf_npj', '\App\Utils\Validator@cpfCnpj');
        Validator::extend('cnh', '\App\Utils\Validator@cnh');
        Validator::extend('voter_title', '\App\Utils\Validator@voterTitle');
        Validator::extend('nis', '\App\Utils\Validator@nis');
        Validator::extend('decimal', '\App\Utils\Validator@decimal');
    }
}
