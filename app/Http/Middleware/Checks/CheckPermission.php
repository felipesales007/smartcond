<?php

namespace App\Http\Middleware\Checks;

use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Models\Route\Route;
use App\Models\User\Permission;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Lidar com uma solicitação recebida.
     *
     * @param $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        // rota acessada
        $url = FormatHelpers::standardize_route($request->getPathInfo());

        // grupos bloqueados que o usuário tem acesso
        $groups = Route::select('groups.*', 'routes.group_id as group_id', DB::raw('concat("/", groups.name, "/", routes.url) as url'))
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->join('permissions', 'permissions.route_id', '=', 'routes.id')
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->whereIn('routes.id', Permission::select('route_id'));

        // rotas que o usuário tem acesso
        $routes = Route::select('groups.*', 'routes.group_id as group_id', DB::raw('concat("/", groups.name, "/", routes.url) as url'))
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->join('permissions', 'permissions.route_id', '=', 'routes.id')
            ->where('permissions.user_id', '=', auth()->user()['id'])
            ->whereIn('routes.id', Permission::select('route_id'));

        // se o usuário não tiver acesso a rota, notificar
        if (!in_array($url, str_replace('/{id?}', '', $routes->pluck('url')->all()))) {
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para acessar a página solicitada.');

            return redirect()->back()->with('notify', json_encode($data));
        }

        // se o grupo estiver bloqueado, notificar
        if (in_array($url, $groups->where('groups.blocked', '!=', null)->pluck('url')->toArray())) {
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Grupo bloqueado para acesso.<br><small>Procure o Administrador para obter mais informações.</small>');

            if ($request->ajax()) {
                return response()->json($data);
            } else {
                return redirect()->back()->with('notify', json_encode($data));
            }
        }

        // se a rota estiver bloqueada, notificar
        if (in_array($url, str_replace('/{id?}', '', $routes->where('routes.blocked', '!=', null)->pluck('url')->toArray()))) {
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Rota bloqueada para acesso.<br><small>Procure o Administrador para obter mais informações.</small>');

            if ($request->ajax()) {
                return response()->json($data);
            } else {
                return redirect()->back()->with('notify', json_encode($data));
            }
        }

        return $next($request);
    }
}
