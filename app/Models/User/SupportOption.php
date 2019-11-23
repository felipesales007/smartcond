<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class SupportOption extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'support_options';

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
    static function getSupportOptions()
    {
        return SupportOption::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return SupportOption
     */
    static function getSupportOption($id)
    {
        return SupportOption::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getSupportOptionsOptions()
    {
        $options = SupportOption::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->name] = $option->name;
        }

        return $array;
    }
}
