<?php

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name'        => 'Amarelo',
            'color'       => 'fe-text-yellow',
            'background'  => 'fe-bg-yellow',
            'transparent' => 'fe-bg-yellow-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Anil',
            'color'       => 'fe-text-indigo',
            'background'  => 'fe-bg-indigo',
            'transparent' => 'fe-bg-indigo-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Azul',
            'color'       => 'fe-text-blue',
            'background'  => 'fe-bg-blue',
            'transparent' => 'fe-bg-blue-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Azul bebê',
            'color'       => 'fe-text-info',
            'background'  => 'fe-bg-info',
            'transparent' => 'fe-bg-info-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Azul escuro',
            'color'       => 'fe-text-default',
            'background'  => 'fe-bg-default',
            'transparent' => 'fe-bg-default-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Azul suave',
            'color'       => 'fe-text-primary',
            'background'  => 'fe-bg-primary',
            'transparent' => 'fe-bg-primary-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Branco',
            'color'       => 'fe-text-white',
            'background'  => 'fe-bg-white',
            'transparent' => 'fe-bg-white-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Branco suave',
            'color'       => 'fe-text-light',
            'background'  => 'fe-bg-light',
            'transparent' => 'fe-bg-light-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Ciano',
            'color'       => 'fe-text-cyan',
            'background'  => 'fe-bg-cyan',
            'transparent' => 'fe-bg-cyan-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Cinza',
            'color'       => 'fe-text-gray',
            'background'  => 'fe-bg-gray',
            'transparent' => 'fe-bg-gray-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Cinza escuro',
            'color'       => 'fe-text-gray-dark',
            'background'  => 'fe-bg-gray-dark',
            'transparent' => 'fe-bg-gray-dark-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Cinza suave',
            'color'       => 'fe-text-secondary',
            'background'  => 'fe-bg-secondary',
            'transparent' => 'fe-bg-secondary-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Laranja',
            'color'       => 'fe-text-orange',
            'background'  => 'fe-bg-orange',
            'transparent' => 'fe-bg-orange-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Laranja escuro',
            'color'       => 'fe-text-warning',
            'background'  => 'fe-bg-warning',
            'transparent' => 'fe-bg-warning-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Preto',
            'color'       => 'fe-text-black',
            'background'  => 'fe-bg-black',
            'transparent' => 'fe-bg-black-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Preto claro',
            'color'       => 'fe-text-darker',
            'background'  => 'fe-bg-darker',
            'transparent' => 'fe-bg-darker-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Preto suave',
            'color'       => 'fe-text-dark',
            'background'  => 'fe-bg-dark',
            'transparent' => 'fe-bg-dark-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Rosa',
            'color'       => 'fe-text-pink',
            'background'  => 'fe-bg-pink',
            'transparent' => 'fe-bg-pink-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Roxo',
            'color'       => 'fe-text-purple',
            'background'  => 'fe-bg-purple',
            'transparent' => 'fe-bg-purple-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Verde',
            'color'       => 'fe-text-success',
            'background'  => 'fe-bg-success',
            'transparent' => 'fe-bg-success-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Verde azulado',
            'color'       => 'fe-text-teal',
            'background'  => 'fe-bg-teal',
            'transparent' => 'fe-bg-teal-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        Color::create([
            'name'        => 'Vermelho',
            'color'       => 'fe-text-danger',
            'background'  => 'fe-bg-danger',
            'transparent' => 'fe-bg-danger-t',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
