<?php

namespace App\Models\Entity;

use App\Models\State;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'entities';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'corporate_name', 'cnpj', 'email', 'contact',
        'postal_code', 'address', 'house_number', 'complement',
        'neighborhood', 'city', 'state_id', 'country', 'logo',
        'last_update_at', 'blocked_at', 'blocked', 'deleted_at'
    ];

    /**
     * Os atributos de bloqueado e excluído.
     *
     * @var array
     */
    protected $dates = [
        'blocked_at', 'deleted_at'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getEntities()
    {
        return Entity::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Entity
     */
    static function getEntity($id)
    {
        return Entity::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Entity::leftJoin('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados com e-mail cadastrado no armazenamento.
     *
     * @return mixed
     */
    static function getCountEmail()
    {
        return Entity::leftJoin('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->where('email', '!=', null)
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados com telefone cadastrado no armazenamento.
     *
     * @return mixed
     */
    static function getCountContact()
    {
        return Entity::leftJoin('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->where('contact', '!=', null)
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return Entity::leftJoin('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->where('blocked', '!=', null)->orWhere('blocked_at', '>=', date('Y-m-d'))
            ->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getEntitiesOptions()
    {
        $options = Entity::select('entities.id', 'entities.name')
            ->leftJoin('entity_accesses', 'entity_accesses.entity_id', '=', 'entities.id')
            ->where(function($query) {
                $query
                    ->where('entities.blocked_at', '<', date('Y-m-d'))
                    ->orWhere('entities.blocked_at', '=', null);
            })
            ->where('entities.blocked', '=', null)
            ->where('entities.deleted_at', '=', null)
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->where('entity_accesses.user_id', '=', auth()->id());
            })
            ->groupBy('entities.name')
            ->get();

        $array = [];

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
    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Retornar o condomínio principal relacionado com o usuário no armazenamento.
     *
     * @return mixed
     */
    static function id()
    {
        return Entity::join('entity_accesses', 'entity_accesses.entity_id', 'entities.id')
            ->where(function($query) {
                $query
                    ->where('entities.blocked_at', '<', date('Y-m-d'))
                    ->orWhere('entities.blocked_at', '=', null);
            })
            ->where('entities.blocked', '=', null)
            ->where('entities.deleted_at', '=', null)
            ->where('entity_accesses.preferred', '=', '1')
            ->where('entity_accesses.user_id', '=', auth()->id())
            ->pluck('entity_id')
            ->first();
    }

    /**
     * Retornar os condomínios relacionado com o usuário no armazenamento.
     *
     * @return mixed
     */
    static function getEntitiesUser()
    {
        return Entity::join('entity_accesses', 'entity_accesses.entity_id', 'entities.id')
            ->where(function($query) {
                $query
                    ->where('entities.blocked_at', '<', date('Y-m-d'))
                    ->orWhere('entities.blocked_at', '=', null);
            })
            ->where('entities.blocked', '=', null)
            ->where('entities.deleted_at', '=', null)
            ->where('entity_accesses.user_id', '=', auth()->id())
            ->pluck('entity_id');
    }

    /**
     * Retornar os condomínios relacionado com o usuário no armazenamento.
     *
     * @param $id
     * @return mixed
     */
    static function getEntitiesUserId($id)
    {
        return Entity::join('entity_accesses', 'entity_accesses.entity_id', 'entities.id')
            ->where(function($query) {
                $query
                    ->where('entities.blocked_at', '<', date('Y-m-d'))
                    ->orWhere('entities.blocked_at', '=', null);
            })
            ->where('entities.blocked', '=', null)
            ->where('entities.deleted_at', '=', null)
            ->where('entity_accesses.user_id', '=', $id)
            ->pluck('entity_id');
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     */
    static function getEntityLogo($id)
    {
        $logo = Entity::find($id)['logo'];

        if ($logo) {
            return url('storage/images/companies/logo/' . $logo);
        }

        return url('images/default/default-logo.png');
    }
}
