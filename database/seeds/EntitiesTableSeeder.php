<?php

use App\Models\Entity\Entity;
use Illuminate\Database\Seeder;

class EntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entity::insert([
            'name'           => 'Empresa de Teste',
            'corporate_name' => 'Empresa para Teste e Desenvolvimento',
            'cnpj'           => '11.228.078/0001-84',
            'email'          => 'teste@hotmail.com',
            'contact'        => '(71) 99999-9999',
            'postal_code'    => '40020-010',
            'address'        => 'Praça Thomé de Souza',
            'neighborhood'   => 'Centro',
            'city'           => 'Salvador',
            'state_id'       => '5',
            'country'        => 'Brasil',
            'last_update_at' => now(),
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
