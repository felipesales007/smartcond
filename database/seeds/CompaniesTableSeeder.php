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
            'name'           => 'Condomínio de Teste',
            'corporate_name' => 'Condomínio de Teste para o Desenvolvimento',
            'cnpj'           => '11.228.078/0001-84',
            'email'          => 'condomínioteste@hotmail.com',
            'contact'        => '(71) 99999-9999',
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
