<?php

use App\Models\Entity\EntityAccesses;
use Illuminate\Database\Seeder;

class EntityAccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityAccesses::insert([
            'entity_id'  => '1',
            'user_id'    => '2',
            'preferred'  => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
