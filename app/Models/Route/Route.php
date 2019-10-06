<?php

namespace App\Models\Route;

use App\Models\Boolean;
use App\Models\Menu\MenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'routes';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'route_option_id', 'view', 'url',  'route',
        'controller', 'description', 'blocked', 'deleted_at'
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
    static function getRoutes()
    {
        return Route::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Route
     */
    static function getRoute($id)
    {
        return Route::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Route::count();
    }

    /**
     * Retornar a contagem de todos os dados do tipo get no armazenamento.
     *
     * @return mixed
     */
    static function getCountGet()
    {
        return Route::where('route_option_id', '=', '1')->count();
    }

    /**
     * Retornar a contagem de todos os dados do tipo post no armazenamento.
     *
     * @return mixed
     */
    static function getCountPost()
    {
        return Route::where('route_option_id', '=', '2')->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return Route::where('blocked', '!=', null)->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getRoutesOptions()
    {
        $options = Route::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->route;
        }

        return $array;
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getGroup()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getRouteOption()
    {
        return $this->belongsTo(RouteOption::class, 'route_option_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getView()
    {
        return $this->belongsTo(Boolean::class, 'view');
    }

    /**
     * Retornar todas as opções url dos dados do armazenamento.
     *
     * @return array
     */
    static function getUrlRoutesOptions()
    {
        $options = Route::where('view', '=', '1')->get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->group_id . ' - ' . $option->url;
        }

        return $array;
    }

    /**
     * Retornar todas as opções route dos dados do armazenamento.
     *
     * @return array
     */
    static function getRouteRoutesOptions()
    {
        $options = Route::where('view', '=', '1')->get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->group_id . ' - ' . $option->route;
        }

        return $array;
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $route
     * @return MenuItem
     */
    static function getRouteBlocked($route)
    {
        return Route::join('menu_items', 'menu_items.route_id', '=', 'routes.id')
            ->where('routes.route', '=', $route)
            ->where('routes.blocked', '!=', null)
            ->pluck('routes.blocked')
            ->all();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $route
     * @return MenuItem
     */
    static function getRouteRoute($route)
    {
        return Route::where('routes.route', '=', $route)->first();
    }
}
