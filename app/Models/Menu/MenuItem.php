<?php

namespace App\Models\Menu;

use App\Models\Boolean;
use App\Models\Company\Company;
use App\Models\User\Permission;
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
        'main', 'hidden', 'description','blocked', 'deleted_at'
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
        if (Company::id() == 1) {
            return MenuItem::count();
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
            return MenuItem::where('blocked', '!=', null)->count();
        } else {
            return 0;
        }
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
    public function getMain()
    {
        return $this->belongsTo(Boolean::class, 'main');
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
        return MenuItem::select('menu_items.id', 'menu_items.menu_id', 'menu_items.name', 'menu_items.button',
            'menu_items.hidden', 'menu_items.blocked', 'menu.menu_option_id', 'groups.blocked as group_blocked',
            'routes.route', 'routes.url', 'routes.blocked as route_blocked')
            ->join('menu', 'menu.id', '=', 'menu_items.menu_id')
            ->join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->join('permissions', 'permissions.route_id', '=', 'menu_items.route_id')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->where('permissions.user_id', '=', auth()->id())
            ->where('routes.deleted_at', '=', null)
            ->where('menu_items.button', '=', null)
            ->orWhere('menu_items.main', '=', '1')
            ->whereIn('menu_items.route_id',
                Permission::select('route_id')
                    ->where('user_id', '=', auth()->id()))
            ->groupBy('id')
            ->orderBy('hidden', 'asc')
            ->orderBy('menu_items.order', 'asc')
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
