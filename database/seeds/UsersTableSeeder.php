<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Felipe Sales dos Santos',
            'cpf'               => '633.398.890-15',
            'rg'                => '1234567890',
            'email'             => 'felipesales007@hotmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('langames'),
            'birthday'          => '1991-06-12',
            'contact'           => '(71) 99140-2371',
            'gender_id'         => '1',
            'course'            => 'Sistemas de Informação',
            'college'           => 'Unifacs',
            'profession'        => 'Desenvolvedor Pleno',
            'company'           => 'Smartcond',
            'postal_code'       => '40010-000',
            'address'           => 'Avenida da França',
            'neighborhood'      => 'Comércio',
            'city'              => 'Salvador',
            'state_id'          => '5',
            'country'           => 'Brasil',
            'description'       => 'Desenvolvedor de sistemas web',
            'admin'             => '1',
            'last_update_at'    => now(),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        User::create(array(
            'name'              => 'Marco Ribeiro',
            'email'             => 'marco.ribeiro@outlook.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'admin'             => '1',
            'last_update_at'    => now(),
            'created_at'        => now(),
            'updated_at'        => now()
        ));

        User::create([
            'name'              => 'Sergio Pinto',
            'email'             => 'sergiopinto.adm@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'admin'             => '1',
            'last_update_at'    => now(),
            'created_at'        => now(),
            'updated_at'        => now()
        ]);
    }
}
