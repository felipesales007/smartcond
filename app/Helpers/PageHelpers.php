<?php

namespace App\Helpers;

use App\Models\Route\Route;

class PageHelpers
{
    /**
     * @param $id
     * @return mixed
     */
    static function page($id)
    {
        return Route::select('groups.id as group', 'routes.id as route', 'menu_items.id as item', 'menu.id as menu',
            'menu.name as menu_name', 'menu_items.name as item_name', 'menu_items.button as button', 'routes.route as router')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->join('menu_items', 'menu_items.route_id', '=', 'routes.id')
            ->join('menu', 'menu.id', '=', 'menu_items.menu_id')
            ->where('menu_items.id', '=', $id)
            ->first()
            ->toArray();
    }
}
