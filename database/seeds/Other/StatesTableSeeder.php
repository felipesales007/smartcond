<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::insert([
            'name'       => 'Acre',
            'uf'         => 'AC',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Alagoas',
            'uf'         => 'AL',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Amapá',
            'uf'         => 'AP',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Amazonas',
            'uf'         => 'AM',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Bahia',
            'uf'         => 'BA',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Ceará',
            'uf'         => 'CE',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Distrito Federal',
            'uf'         => 'DF',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Espírito Santo',
            'uf'         => 'ES',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Goiás',
            'uf'         => 'GO',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Maranhão',
            'uf'         => 'MA',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Mato Grosso',
            'uf'         => 'MT',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Mato Grosso do Sul',
            'uf'         => 'MS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Minas Gerais',
            'uf'         => 'MG',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Pará',
            'uf'         => 'PA',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Paraíba',
            'uf'         => 'PB',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Paraná',
            'uf'         => 'PR',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Pernambuco',
            'uf'         => 'PE',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Piauí',
            'uf'         => 'PI',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Rio de Janeiro',
            'uf'         => 'RJ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Rio Grande do Norte',
            'uf'         => 'RN',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Rio Grande do Sul',
            'uf'         => 'RS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Rondônia',
            'uf'         => 'RO',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Roraima',
            'uf'         => 'RR',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Santa Catarina',
            'uf'         => 'SC',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'São Paulo',
            'uf'         => 'SP',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Sergipe',
            'uf'         => 'SE',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        State::insert([
            'name'       => 'Tocantins',
            'uf'         => 'TO',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
