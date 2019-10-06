<?php

namespace App\Models\Inventory;

use App\Models\Company\Company;
use App\Models\Company\Departament;
use App\Models\State;
use App\Models\Voltage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'inventory';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'department_id', 'state_id', 'voltage_id', 'patrimonial_number',
        'item', 'brand', 'model', 'serial_number', 'invoice', 'value', 'description',
        'purchase_date', 'warranty_date', 'blocked', 'deleted_at'
    ];

    /**
     * Os atributos de excluído.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getInventories()
    {
        return Inventory::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Inventory
     */
    static function getInventory($id)
    {
        return Inventory::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getInventoriesOptions()
    {
        $options = Inventory::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->name;
        }

        return $array;
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getCompanies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getDepartment()
    {
        return $this->belongsTo(Departament::class, 'department_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getVoltage()
    {
        return $this->belongsTo(Voltage::class, 'voltage_id');
    }
}
