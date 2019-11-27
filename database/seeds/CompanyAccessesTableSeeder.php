<?php

use App\Models\Company\CompanyAccess;
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
        CompanyAccess::insert([
            'company_id' => '1',
            'user_id'    => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        CompanyAccess::insert([
            'company_id' => '1',
            'user_id'    => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        CompanyAccess::insert([
            'company_id' => '1',
            'user_id'    => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
