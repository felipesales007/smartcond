<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boolean extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'boolean';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'translation'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getBooleans()
    {
        return Boolean::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Boolean
     */
    static function getBoolean($id)
    {
        return Boolean::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getBooleanOptions()
    {
        $options = Boolean::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->translation;
        }

        return $array;
    }
}
