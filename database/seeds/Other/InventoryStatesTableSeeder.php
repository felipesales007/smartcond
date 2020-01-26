<?php

use App\Models\Inventory\InventoryState;
use Illuminate\Database\Seeder;

class InventoryStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryState::insert([
            'name'        => 'Novo',
            'description' => 'Item recém comprado ou em estado de boa conservação',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        InventoryState::insert([
            'name'        => 'Marcas de uso',
            'description' => 'Item com algumas marcas de uso aparentes',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        InventoryState::insert([
            'name'        => 'Usado',
            'description' => 'Item com muitas marcas de uso aparentes',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        InventoryState::insert([
            'name'        => 'Velho',
            'description' => 'Item em estado muito ruim de conservação',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        InventoryState::insert([
            'name'        => 'Com avaria',
            'description' => 'Item que apresenta problemas técnicos ou funcionamento irregular',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        InventoryState::insert([
            'name'        => 'Quebrado',
            'description' => 'Item que não funciona',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
