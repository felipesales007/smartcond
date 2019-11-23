<?php

use App\Models\Company\CompanyAccesses;
use Illuminate\Database\Seeder;

class CompanyAccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyAccesses::insert([
            'company_id' => '1',
            'user_id'    => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
