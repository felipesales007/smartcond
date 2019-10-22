<?php

use App\Models\SupportOption;
use Illuminate\Database\Seeder;

class SupportOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupportOption::insert([
            'name'       => 'Elogio',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportOption::insert([
            'name'       => 'Sugestão',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportOption::insert([
            'name'       => 'Dúvida',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportOption::insert([
            'name'       => 'Crítica',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportOption::insert([
            'name'       => 'Erro ou problema',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportOption::insert([
            'name'       => 'Outro motivo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
