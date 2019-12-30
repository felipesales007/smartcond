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
        // 1 - home
        Group::create([
            'name'          => 'home',
            'user_level_id' => '3',
            'description'   => 'Grupo da página inicial',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 2 - perfil
        Group::create([
            'name'          => 'perfil',
            'user_level_id' => '3',
            'description'   => 'Grupo do perfil do usuário logado',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 3 - gerenciamento
        Group::create([
            'name'          => 'gerenciamento/administradores',
            'user_level_id' => '2',
            'description'   => 'Grupo das configurações dos administradores',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 4 - gerenciamento
        Group::create([
            'name'          => 'gerenciamento/usuarios',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações dos usuários',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 5 - gerenciamento
        Group::create([
            'name'          => 'gerenciamento/empresas',
            'user_level_id' => '1',
            'description'   => 'Grupo das configurações das empresas',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 6 - gerenciamento
        Group::create([
            'name'          => 'gerenciamento/condominios',
            'user_level_id' => '2',
            'description'   => 'Grupo das configurações dos condomínios',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 7 - gerenciamento
        Group::create([
            'name'          => 'gerenciamento/permissoes',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações das permissões do usuário',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 8 - layout
        Group::create([
            'name'          => 'layout/grupos',
            'user_level_id' => '1',
            'description'   => 'Grupo das configurações dos grupos',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 9 - layout
        Group::create([
            'name'          => 'layout/rotas',
            'user_level_id' => '1',
            'description'   => 'Grupo das configurações das rotas',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 10 - layout
        Group::create([
            'name'          => 'layout/menu',
            'user_level_id' => '1',
            'description'   => 'Grupo das configurações dos menu',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 11 - layout
        Group::create([
            'name'          => 'layout/menu-itens',
            'user_level_id' => '1',
            'description'   => 'Grupo das configurações dos itens do menu',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 12 - administrativo
        Group::create([
            'name'          => 'administrativo/departamentos',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações das departamentos',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 13 - administrativo
        Group::create([
            'name'          => 'administrativo/inventario/categorias',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações das categorias do inventário',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 14 - administrativo
        Group::create([
            'name'          => 'administrativo/inventario',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações dos inventário',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // 15 - condominio
        Group::create([
            'name'          => 'condominio/blocos',
            'user_level_id' => '3',
            'description'   => 'Grupo das configurações dos blocos do condomínio',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
