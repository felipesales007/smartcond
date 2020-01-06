<?php

namespace App\Models\Condominium;

use App\Models\Entity\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondominiumApartment extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'condominium_apartments';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'block_id', 'name', 'description'
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
    static function getCondominiumApartments()
    {
        return CondominiumApartment::where('entity_id', '=', Entity::id())->get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return CondominiumApartment
     */
    static function getCondominiumApartment($id)
    {
        return CondominiumApartment::where('entity_id', '=', Entity::id())->find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return CondominiumApartment::where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountDeleted()
    {
        return CondominiumApartment::onlyTrashed()->where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getCondominiumApartmentsOptions()
    {
        $options = CondominiumApartment::where('entity_id', '=', Entity::id())->get();
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
    public function getBlock()
    {
        return $this->belongsTo(CondominiumBlock::class, 'block_id');
    }
}
