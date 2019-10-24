<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryState extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'inventory_states';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getInventoyStates()
    {
        return InventoryState::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return InventoryState
     */
    static function getInventoyState($id)
    {
        return InventoryState::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getInventoyStatesOptions()
    {
        $options = InventoryState::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->name;
        }

        return $array;
    }
}
