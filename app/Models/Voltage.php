<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voltage extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'voltages';

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
    static function getVoltages()
    {
        return Voltage::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Voltage
     */
    static function getVoltage($id)
    {
        return Voltage::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getVoltagesOptions()
    {
        $options = Voltage::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->name;
        }

        return $array;
    }
}
