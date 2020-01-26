<?php

use App\Models\Entity\Entity;
use Illuminate\Database\Seeder;

class TempEntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entity::insert([
            'name'           => 'Condomínio Varandas do Vale',
            'corporate_name' => 'Condomínio Residencal Varandas do Vale',
            'cnpj'           => '11.228.078/0001-84',
            'email'          => 'teste@hotmail.com',
            'contact'        => '(71) 99999-9999',
            'postal_code'    => '41218-168',
            'address'        => 'Rua Varandas da Serra',
            'neighborhood'   => 'Novo Horizonte',
            'city'           => 'Salvador',
            'state_id'       => '5',
            'country'        => 'Brasil',
            'last_update_at' => now(),
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
