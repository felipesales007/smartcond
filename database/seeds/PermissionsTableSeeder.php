<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // rotas no sistema
        $routes = 110;

        /*
         * Permissões de
         * Felipe Sales dos Santos
         */
        for ($i = 1; $i <= $routes; $i++) {
            Permission::create([
                'user_id'    => '1',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        /*
         * Permissões de
         * Usuário Master One
         */
        for ($i = 1; $i <= $routes; $i++) {
            Permission::create([
                'user_id'    => '2',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        /*
         * Permissões de
         * Usuário Master Two
         */
        for ($i = 1; $i <= $routes; $i++) {
            Permission::create([
                'user_id'    => '3',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
