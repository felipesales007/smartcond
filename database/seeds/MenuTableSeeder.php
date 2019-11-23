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
        // 1 - home (link)
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

        // 2 - perfil (link)
        Menu::create([
            'menu_option_id' => '3',
            'color_id'       => '6',
            'order'          => '1',
            'hidden'         => '1',
            'name'           => 'Meu perfil',
            'icon'           => 'fas fa-star',
            'description'    => 'Menu oculto com link da página do perfil do usuário',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // 3 - perfil (dropdown)
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

        // 4 - perfil (dropdown)
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

        // 5 - perfil (dropdown)
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

        // 6 - gerenciamento (collapse)
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '3',
            'name'           => 'Gerenciamento',
            'icon'           => 'fas fa-user-cog',
            'description'    => 'Menu em collapse da página de configurações de administradores, usuários, empresas e entidades',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // 7 - layout (collapse)
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '4',
            'name'           => 'Layout',
            'icon'           => 'fas fa-list-ul',
            'description'    => 'Menu em collapse da página de configurações de grupos, rotas, menu e itens do menu',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        // 8 - administrativo (collapse)
        Menu::create([
            'menu_option_id' => '1',
            'color_id'       => '6',
            'order'          => '2',
            'name'           => 'Administrativo',
            'icon'           => 'fas fa-folder',
            'description'    => 'Menu em collapse da página de configurações de departamentos',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
