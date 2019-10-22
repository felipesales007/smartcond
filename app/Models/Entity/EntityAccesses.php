<?php

namespace App\Models\Entity;

use App\Models\Boolean;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntityAccesses extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'entity_accesses';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'user_id', 'preferred'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getEntityAccesses()
    {
        return EntityAccesses::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return EntityAccesses
     */
    static function getEntityAccess($id)
    {
        return EntityAccesses::find($id);
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
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getPreferred()
    {
        return $this->belongsTo(Boolean::class, 'preferred');
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return EntityAccesses
     */
    static function getEntityAccessesUser($id)
    {
        return EntityAccesses::where('user_id', '=', $id)->first();
    }
}
