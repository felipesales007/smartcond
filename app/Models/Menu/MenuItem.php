<?php

namespace App\Models\Menu;

use App\Models\Boolean;
use App\Models\Permission;
use App\Models\Route\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id', 'route_id', 'order', 'name', 'button',
        'list', 'hidden', 'description','blocked', 'deleted_at'
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
    static function getMenuItems()
    {
        return MenuItem::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return MenuItem
     */
    static function getMenuItem($id)
    {
        return MenuItem::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return MenuItem::count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return MenuItem::where('blocked', '!=', null)->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getMenuItemsOptions()
    {
        $options = MenuItem::get();
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
    public function getMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
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
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getList()
    {
        return $this->belongsTo(Boolean::class, 'list');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getHide()
    {
        return $this->belongsTo(Boolean::class, 'hidden');
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return MenuItem
     */
    static function getMenuId($id)
    {
        return MenuItem::join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->where('routes.deleted_at', '=', null)
            ->where('menu_id', '=', $id)
            ->first();
    }

    /**
     * Retornar todos os dados do armazenamento relacionados com o usuário.
     *
     * @return array
     */
    static function getUserMenuItems()
    {
        return MenuItem::select('menu_items.*')
            ->join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->join('permissions', 'permissions.route_id', '=', 'menu_items.route_id')
            ->where('routes.deleted_at', '=', null)
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->where('menu_items.list', '=', '0')
            ->whereIn('menu_items.route_id', Permission::select('route_id'))
            ->groupBy('id')
            ->orderBy('hidden', 'asc')
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $route
     * @return MenuItem
     */
    static function getMenuItemBlocked($route)
    {
        return MenuItem::join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->where('routes.route', '=', $route)
            ->where('menu_items.blocked', '!=', null)
            ->first();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $route
     * @return MenuItem
     */
    static function getMenuItemDeleted($route)
    {
        return MenuItem::join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->where('routes.route', '=', $route)
            ->first();
    }
}
