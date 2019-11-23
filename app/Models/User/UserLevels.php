<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserLevels extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'user_levels';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getUserLevels()
    {
        return UserLevels::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Gender
     */
    static function getUserLevel($id)
    {
        return UserLevels::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getUserLevelsOptions()
    {
        $options = UserLevels::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->name;
        }

        return $array;
    }
}
