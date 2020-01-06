<?php

namespace App\Models\Condominium;

use App\Models\Entity\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondominiumBlock extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'condominium_blocks';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'name', 'description'
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
    static function getCondominiumBlocks()
    {
        return CondominiumBlock::where('entity_id', '=', Entity::id())->get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return CondominiumBlock
     */
    static function getCondominiumBlock($id)
    {
        return CondominiumBlock::where('entity_id', '=', Entity::id())->find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return CondominiumBlock::where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountDeleted()
    {
        return CondominiumBlock::onlyTrashed()->where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getCondominiumBlocksOptions()
    {
        $options = CondominiumBlock::where('entity_id', '=', Entity::id())->orderByRaw('length(name)')->orderBy('name')->get();
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
}
