<?php

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::insert([
            'name'       => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Gender::insert([
            'name'       => 'Feminino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Gender::insert([
            'name'       => 'Não binário',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
