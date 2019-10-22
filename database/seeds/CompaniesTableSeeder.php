<?php

use App\Models\Company\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert([
            'name'           => 'Grupo Smartcond',
            'corporate_name' => 'Grupo Smartcond de Desenvolvimento Ltda',
            'cnpj'           => '83.442.866/0001-80',
            'email'          => 'contato@gruposmartcond.com',
            'contact'        => '(71) 3333-3333',
            'postal_code'    => '40010-000',
            'address'        => 'Avenida da França',
            'neighborhood'   => 'Comércio',
            'city'           => 'Salvador',
            'state_id'       => '5',
            'country'        => 'Brasil',
            'last_update_at' => now(),
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
