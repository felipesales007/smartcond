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

        RouteOption::create([
            'name'        => 'put',
            'description' => 'Atualização',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        RouteOption::create([
            'name'        => 'delete',
            'description' => 'Exclusão',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

//        RouteOption::create([
//            'name'        => 'patch',
//            'description' => 'Atualização',
//            'created_at'  => now(),
//            'updated_at'  => now()
//        ]);
//
//        RouteOption::create([
//            'name'        => 'any',
//            'description' => 'Criação e atualização',
//            'created_at'  => now(),
//            'updated_at'  => now()
//        ]);
//
//        RouteOption::create([
//            'name'        => 'match',
//            'description' => 'Criação e atualização',
//            'created_at'  => now(),
//            'updated_at'  => now()
//        ]);
//
//        RouteOption::create([
//            'name'        => 'options',
//            'description' => 'Condição',
//            'created_at'  => now(),
//            'updated_at'  => now()
//        ]);
    }
}
