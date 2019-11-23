<?php

use App\Models\User\UserLevels;
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
        UserLevels::insert([
            'name'       => 'Master',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserLevels::insert([
            'name'       => 'Administrador',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserLevels::insert([
            'name'       => 'Usuário',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
