<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BooleanTableSeeder::class,
            ColorsTableSeeder::class,
            StatesTableSeeder::class,
            GendersTableSeeder::class,
            UserLevelsTableSeeder::class,
            GroupsTableSeeder::class,
            MenuOptionsTableSeeder::class,
            MenuTableSeeder::class,
            RouteOptionsTableSeeder::class,
            RoutesTableSeeder::class,
            MenuItemsTableSeeder::class,
            UsersTableSeeder::class,
            CompaniesTableSeeder::class,
            CompanyAccessesTableSeeder::class,
            EntitiesTableSeeder::class,
            EntityAccessesTableSeeder::class,
            PermissionsTableSeeder::class,
            AuthPicturesTableSeeder::class,
            SupportOptionsTableSeeder::class
        ]);
    }
}
