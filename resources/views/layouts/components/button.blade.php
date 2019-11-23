@if ($button)
    @if (app('router')->has($router) && \App\Models\User\Permission::routePermission($router) && \App\Models\Menu\MenuItem::getMenuItemDeleted($router))
        <a href="javascript:void(0)" class="btn btn-icon btn-{{ $size }} btn-{{ $color }} {{ \App\Models\Route\Group::getGroup($group)['blocked'] || \App\Models\Route\Route::getRoute($route)['blocked'] || \App\Models\Menu\Menu::getMenu($menu)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($item)['blocked'] ? '' : $button }} {{ \App\Models\Route\Group::getGroup($group)['blocked'] ? 'notify-block-group' : '' }} {{ \App\Models\Route\Route::getRoute($route)['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenu($menu)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($item)['blocked'] ? 'opacity-2 disabled' : '' }}" title="{{ $title }}">
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            @if ($text)
                <span class="fe-button-sm-left">
                    <span class="nav-link-inner--text d-none d-md-inline ml--1">{{ $text }}</span>
                </span>
            @endif
        </a>
    @endif
@else
    @if (app('router')->has($router) && \App\Models\User\Permission::routePermission($router) && \App\Models\Menu\MenuItem::getMenuItemDeleted($router))
        <a href="{{ \App\Models\Route\Group::getGroup($group)['blocked'] || \App\Models\Route\Route::getRoute($route)['blocked'] || \App\Models\Menu\Menu::getMenu($menu)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($item)['blocked'] ? 'javascript:void(0)' : route($router) }}" class="btn btn-icon btn-{{ $size }} btn-{{ $color }} {{ \App\Models\Route\Group::getGroup($group)['blocked'] || \App\Models\Route\Route::getRoute($route)['blocked'] || \App\Models\Menu\Menu::getMenu($menu)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($item)['blocked'] ? '' : 'fe-loading' }} {{ \App\Models\Route\Group::getGroup($group)['blocked'] ? 'notify-block-group' : '' }} {{ \App\Models\Route\Route::getRoute($route)['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenu($menu)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($item)['blocked'] ? 'opacity-2 disabled' : '' }}" title="{{ $title }}">
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            @if ($text)
                <span class="fe-button-sm-left">
                    <span class="nav-link-inner--text d-none d-md-inline ml--1">{{ $text }}</span>
                </span>
            @endif
        </a>
    @endif
@endif
