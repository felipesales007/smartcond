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
            'corporate_name' => 'Grupo Smartcond Sistemas',
            'cnpj'           => '43.208.147/0001-84',
            'email'          => 'felipesales007@hotmail.com',
            'contact'        => '(71) 3333-3333',
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
