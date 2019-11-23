<?php

use App\Models\Route\RouteOption;
use Illuminate\Database\Seeder;

class RouteOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RouteOption::create([
            'name'        => 'get',
            'description' => 'Retorno',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        RouteOption::create([
            'name'        => 'post',
            'description' => 'Criação',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
