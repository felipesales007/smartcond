<?php

namespace App\Models\Inventory;

use App\Models\Department;
use App\Models\Entity\Entity;
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
    protected $table = 'inventories';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'entity_id', 'department_id', 'inventory_category_id', 'inventory_state_id',
        'voltage_id', 'patrimonial_number', 'name', 'brand', 'model', 'serial_number', 'invoice',
        'value', 'description', 'purchase_date', 'warranty_date', 'deleted_at'
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
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Inventory::where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountDeleted()
    {
        return Inventory::where('entity_id', '=', Entity::id())->where('deleted_at', '!=', null)->count();
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
    public function getEntity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getCategory()
    {
        return $this->belongsTo(InventoryCategory::class, 'inventory_category_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getState()
    {
        return $this->belongsTo(InventoryState::class, 'inventory_state_id');
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
