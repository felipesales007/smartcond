<?php

namespace App\Models\Menu;

use App\Models\Boolean;
use App\Models\Color;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'menu_option_id', 'color_id', 'hidden', 'order',
        'name', 'icon', 'description','blocked', 'deleted_at'
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
    static function getMenus()
    {
        return Menu::get();
    }

    /**
     * Retornar o dado especificado do armazenamento.
     *
     * @param $id
     * @return Menu
     */
    static function getMenu($id)
    {
        return Menu::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Menu::count();
    }

    /**
     * Retornar a contagem de todos os dados do tipo collapse no armazenamento.
     *
     * @return mixed
     */
    static function getCountCollapses()
    {
        return Menu::where('menu_option_id', '=', '1')->count();
    }

    /**
     * Retornar a contagem de todos os dados do tipo dropdown no armazenamento.
     *
     * @return mixed
     */
    static function getCountDropdowns()
    {
        return Menu::where('menu_option_id', '=', '2')->count();
    }

    /**
     * Retornar a contagem de todos os dados do tipo link no armazenamento.
     *
     * @return mixed
     */
    static function getCountLinks()
    {
        return Menu::where('menu_option_id', '=', '3')->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return Menu::where('blocked', '!=', null)->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getMenuOptions()
    {
        $options = Menu::get();
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
    public function getMenuOption()
    {
        return $this->belongsTo(MenuOption::class, 'menu_option_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getColor()
    {
        return $this->belongsTo(Color::class, 'color_id');
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
     * Retornar todos os dados do armazenamento relacionados com o usuário.
     *
     * @return array
     */
    static function getUserMenu()
    {
        return Menu::select('menu.*')
            ->join('menu_items', 'menu_items.menu_id', '=', 'menu.id')
            ->join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->join('permissions', 'permissions.route_id', '=', 'routes.id')
            ->where('groups.deleted_at', '=', null)
            ->where('routes.deleted_at', '=', null)
            ->where('menu_items.deleted_at', '=', null)
            ->where('menu_items.list', '=', '0')
            ->where('menu_items.hidden', '=', '0')
            ->where('permissions.user_id', '=', auth()->user()['id'])
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
     * @return Menu
     */
    static function getMenuBlocked($route)
    {
        return Menu::join('menu_items', 'menu_items.menu_id', '=', 'menu.id')
            ->join('routes', 'routes.id', '=', 'menu_items.route_id')
            ->where('routes.route', '=', $route)
            ->where('menu.blocked', '!=', null)
            ->pluck('menu.blocked')
            ->all();
    }
}
