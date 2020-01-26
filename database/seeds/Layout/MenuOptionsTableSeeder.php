<?php

use App\Models\Menu\MenuOption;
use Illuminate\Database\Seeder;

class MenuOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuOption::create([
            'name'        => 'Collapse',
            'description' => 'Menu lateral do sistema com vários links de acesso a uma página',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuOption::create([
            'name'        => 'Dropdown',
            'description' => 'Menu da barra do sistema com vários links de acesso a uma página',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuOption::create([
            'name'        => 'Link',
            'description' => 'Menu lateral do sistema com um único link de acesso a uma página',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
