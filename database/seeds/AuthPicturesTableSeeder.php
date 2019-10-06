<?php

use App\Models\AuthPicture;
use Illuminate\Database\Seeder;

class AuthPicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthPicture::insert([
            'number'      => '1',
            'image'       => 'info-1.png',
            'title'       => 'Gerenciando seus dados de forma prática',
            'description' => 'com acesso facilitado via web e mobile',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        AuthPicture::insert([
            'number'      => '2',
            'image'       => 'info-2.png',
            'title'       => 'Controle de acesso de seus usuários',
            'description' => 'controle de visualização, edição, e exclusão de forma simplificada',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
