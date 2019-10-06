<?php

use App\Models\Voltage;
use Illuminate\Database\Seeder;

class VoltagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voltage::insert([
            'name'       => 'n/s',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Voltage::insert([
            'name'       => '110v',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Voltage::insert([
            'name'       => '220v',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
