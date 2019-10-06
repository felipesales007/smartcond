<?php

namespace App\Models;

use App\Models\Route\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'route_id'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getPermissions()
    {
        return Permission::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Permission
     */
    static function getPermission($id)
    {
        return Permission::find($id);
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
    public function getRoute()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    /**
     * Verificar se o usuário tem permissão ao dado especificado no armazenamento.
     *
     * @param $button
     * @return bool
     */
    static function buttonPermission($button)
    {
        $permission = Permission::join('menu_items', 'menu_items.route_id', '=', 'permissions.route_id')
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->where('menu_items.button', '!=', null)
            ->where('menu_items.button', '=', $button)
            ->pluck('menu_items.button')
            ->first();

        return !empty($permission);
    }

    /**
     * Verificar se o usuário tem permissão ao dado especificado no armazenamento.
     *
     * @param $route
     * @return bool
     */
    static function routePermission($route)
    {
        $permission = Permission::join('routes', 'routes.id', '=', 'permissions.route_id')
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->where('routes.route', '=', $route)
            ->pluck('routes.route')
            ->first();

        return !empty($permission);
    }

    /**
     * Retornar a contagem de permissões por grupos do usuário logado.
     *
     * @param $group
     * @return mixed
     */
    static function profilePermission($group)
    {
        return Permission::join('routes', 'routes.id', '=', 'permissions.route_id')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->where('groups.id', '=', $group)
            ->count();
    }

    /**
     * Retornar a contagem de permissões por grupos do usuário em edição.
     *
     * @param $group
     * @param $user
     * @return mixed
     */
    static function userPermission($group, $user)
    {
        return Permission::select('route_id')
            ->selectRaw('count(route_id) as equal')
            ->join('routes', 'routes.id', '=', 'permissions.route_id')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->whereIn('permissions.user_id', [$user, auth()->id()])
            ->where('groups.id', '=', $group)
            ->groupBy('route_id')
            ->having('equal', '>', '1')
            ->pluck('equal')
            ->count();
    }
}
