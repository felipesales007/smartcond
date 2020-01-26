<?php

use App\Models\User\Permission;
use Illuminate\Database\Seeder;

class TempPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // rotas no banco
        $routes = 147;

        for ($i = 1; $i <= $routes; $i++) {
            Permission::create([
                'user_id'    => '4',
                'route_id'   => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
