<?php

/** @var Factory $factory */

use App\Models\User\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Fábricas modelo
|--------------------------------------------------------------------------
|
| Este diretório deve conter cada uma das definições de fábrica do modelo para
| sua aplicação Fábricas fornecem uma maneira conveniente de gerar novos
| instâncias de modelo para testar / semear o banco de dados do seu aplicativo.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => Hash::make('12345678'),
        'last_update_at'    => now(),
        'remember_token'    => Str::random(10),
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
