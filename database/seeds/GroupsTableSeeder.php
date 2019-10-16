<?php

use App\Models\Route\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name'        => 'home',
            'description' => 'Grupo da página inicial',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'perfil',
            'description' => 'Grupo do perfil do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'usuarios',
            'description' => 'Grupo das configurações de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'condominios',
            'description' => 'Grupo das configurações de condomínios',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'rotas',
            'description' => 'Grupo das configurações de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'menu',
            'description' => 'Grupo das configurações de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'permissoes',
            'description' => 'Grupo das configurações de permissões de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'departamentos',
            'description' => 'Grupo das configurações dos departamentos do condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'inventario',
            'description' => 'Grupo das configurações dos itens do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Group::create([
            'name'        => 'moradores',
            'description' => 'Grupo das configurações dos moradores',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
