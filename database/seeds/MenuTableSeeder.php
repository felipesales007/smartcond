<?php

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // grupo home
        Menu::create([
            'menu_option_id' => '3',
            'color_id'       => '6',
            'order'          => '1',
            'name'           => 'Home',
            'icon'           => 'fas fa-home',
            'description'    => 'Menu com link da página inicial',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo perfil
        Menu::create([
            'menu_option_id' => '3',
            'color_id'       => '6',
            'order'          => '1',
            'hidden'         => '1',
            'name'           => 'Meu perfil',
            'icon'           => 'fas fa-star',
            'description'    => 'Menu com link da página do perfil do usuário',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        Menu::create([
            'menu_option_id' => '2',
            'color_id'       => '16',
            'order'          => '1',
            'name'           => 'Meu perfil',
            'icon'           => 'fas fa-user',
            'description'    => 'Menu dropdown da página do perfil do usuário',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        Menu::create([
            'menu_option_id' => '2',
            'color_id'       => '16',
            'order'          => '2',
            'name'           => 'Alterar senha',
            'icon'           => 'fas fa-key',
            'description'    => 'Menu dropdown da página de alteração da senha do usuário logado',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        Menu::create([
            'menu_option_id' => '2',
            'color_id'       => '16',
            'order'          => '3',
            'name'           => 'Suporte',
            'icon'           => 'fas fa-dharmachakra',
            'description'    => 'Menu dropdown da página de contato via e-mail com o suporte do sistema',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo usuários
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '2',
            'name'           => 'Usuários',
            'icon'           => 'fas fa-user',
            'description'    => 'Menu em collapse da página de configurações de usuários',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo empresas
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '4',
            'name'           => 'Empresas',
            'icon'           => 'fas fa-hotel',
            'description'    => 'Menu em collapse da página de configurações de empresas',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo rotas
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '6',
            'name'           => 'Grupos e Rotas',
            'icon'           => 'fas fa-book',
            'description'    => 'Menu em collapse da página de configurações de rotas',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo menu
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '7',
            'name'           => 'Menu e Itens',
            'icon'           => 'fas fa-list-ul',
            'description'    => 'Menu em collapse da página de configurações de menu',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo permissões
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '3',
            'name'           => 'Permissões',
            'icon'           => 'fas fa-unlock',
            'description'    => 'Menu em collapse da página de permissões do usuário',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // grupo departamentos
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '5',
            'name'           => 'Departamentos',
            'icon'           => 'far fa-building',
            'description'    => 'Menu em collapse da página de departametos da empresa',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
