<?php

use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name'         => 'Felipe Sales dos Santos',
            'cpf'          => '633.398.890-15',
            'rg'           => '1234567890',
            'email'        => 'felipesales007@hotmail.com',
            'password'     => Hash::make('langames'),
            'birthday'     => '1991-06-12',
            'contact'      => '(71) 99140-2371',
            'gender_id'    => '1',
            'course'       => 'Sistemas de Informação',
            'college'      => 'Unifacs',
            'profession'   => 'Desenvolvedor Pleno',
            'company'      => 'Grupo Smartcond',
            'postal_code'  => '41218-168',
            'address'      => 'Rua Varandas da Serra',
            'neighborhood' => 'Novo Horizonte',
            'city'         => 'Salvador',
            'state_id'     => '5',
            'country'      => 'Brasil',
            'description'  => 'Desenvolvedor de sistemas web',
            'admin'        => '1'
        ]);

        factory(User::class)->create([
            'name'  => 'Marco Ribeiro',
            'email' => 'marco.ribeiro@outlook.com',
            'admin' => '1'
        ]);

        factory(User::class)->create([
            'name'  => 'Sergio Pinto',
            'email' => 'sergiopinto.adm@gmail.com',
            'admin' => '1'
        ]);
    }
}
