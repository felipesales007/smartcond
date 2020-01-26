<?php

use App\Models\Entity\EntityAccess;
use Illuminate\Database\Seeder;

class TempEntityAccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityAccess::insert([
            'entity_id'  => '1',
            'user_id'    => '4',
            'preferred'  => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
