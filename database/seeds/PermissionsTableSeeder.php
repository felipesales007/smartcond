<?php

use App\Models\User\Permission;
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
        // rotas no banco
        $routes = 131;

        for ($i = 1; $i <= $routes; $i++) {
            Permission::create([
                'user_id'    => '1',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Permission::create([
                'user_id'    => '2',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Permission::create([
                'user_id'    => '3',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Permission::create([
                'user_id'    => '4',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
