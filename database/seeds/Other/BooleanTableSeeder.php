<?php

use App\Models\Boolean;
use Illuminate\Database\Seeder;

class BooleanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Boolean::create([
            'id'          => '0',
            'name'        => 'false',
            'translation' => 'Falso',
            'condition'   => 'Não',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Boolean::create([
            'id'          => '1',
            'name'        => 'true',
            'translation' => 'Verdadeiro',
            'condition'   => 'Sim',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
