<?php

namespace App\Models\Route;

use App\Models\Company\Company;
use App\Models\User\UserLevels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_level_id', 'name', 'description', 'blocked', 'deleted_at'
    ];

    /**
     * Os atributos de bloqueado e excluído.
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
    static function getGroups()
    {
        return Group::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Group
     */
    static function getGroup($id)
    {
        return Group::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        if (Company::id() == 1) {
            return Group::count();
        } else {
            return 0;
        }
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        if (Company::id() == 1) {
            return Group::where('blocked', '!=', null)->count();
        } else {
            return 0;
        }
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getGroupsOptions()
    {
        $options = Group::get();
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
    public function getUserLevel()
    {
        return $this->belongsTo(UserLevels::class, 'user_level_id');
    }
}
