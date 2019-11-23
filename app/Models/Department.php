<?php

namespace App\Models;

use App\Models\Entity\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id', 'name', 'description', 'blocked'
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
    static function getDepartments()
    {
        return Department::where('entity_id', '=', Entity::id())->get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Department
     */
    static function getDepartment($id)
    {
        return Department::where('entity_id', '=', Entity::id())->find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Department::where('entity_id', '=', Entity::id())->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return Department::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getDepartmentsOptions()
    {
        $options = Department::where('entity_id', '=', Entity::id())->where('blocked', '=', null)->get();
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
