<?php

use App\Models\User\UserLevel;
use Illuminate\Database\Seeder;

class UserLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::insert([
            'name'       => 'Master',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserLevel::insert([
            'name'       => 'Administrador',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserLevel::insert([
            'name'       => 'Usuário',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
