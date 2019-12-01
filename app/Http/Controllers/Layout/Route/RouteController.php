<?php

namespace App\Http\Controllers\Layout\Route;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Layout\Route\BlockRouteRequest;
use App\Http\Requests\Layout\Route\DeleteRouteRequest;
use App\Http\Requests\Layout\Route\EditRouteRequest;
use App\Http\Requests\Layout\Route\NewRouteRequest;
use App\Http\Requests\Layout\Route\RecoverRouteRequest;
use App\Models\Company\Company;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use App\Models\Route\Route;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RouteController extends Controller
{
    /**
     * Exibir uma listagem do recurso.
     *
     * @param Request $request
     * @return Factory|JsonResponse|View|mixed
     * @throws Exception
     */
    public function list(Request $request)
    {
        // impede o acesso não autorizado
        if (Company::id() != 1) {
            if ($request->ajax()) {
                return datatables([])->toJson();
            }

            return view('layout.routes.tables.all.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'group asc');

        $collection = Route::query()
            ->select('routes.*', 'groups.name as group', 'route_options.name as type')
            ->join('groups', 'groups.id', 'routes.group_id')
            ->join('route_options', 'route_options.id', 'routes.route_option_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('groups.name', 'like', '%' . $search . '%')
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('route', 'like', '%' . $search . '%')
                    ->orWhere('controller', 'like', '%' . $search . '%')
                    ->orWhere('route_options.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna grupo
                ->addColumn('group', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->getGroup['name'] . '" title="' . $row->getGroup['description'] . '">' . $row->getGroup['name'] . '</span>';
                })
                // coluna url
                ->addColumn('url', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->url . '" title="' . $row->description . '">' . $row->url . '</span>';
                })
                // coluna rota
                ->addColumn('route', function ($row) {
                    return $row->route;
                })
                // coluna controle
                ->addColumn('controller', function ($row) {
                    return $row->controller;
                })
                // coluna opção da rota
                ->addColumn('route_option', function ($row) {
                    return $row->getRouteOption['name'];
                })
                // coluna página
                ->addColumn('view', function ($row) {
                    if ($row->view == 1) {
                        return '<i class="far fa-check-square"><span class="fe-print">Sim</span></i>';
                    } else {
                        return '<span class="fe-print">Não</span>';
                    }
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('route.view') && MenuItem::getMenuItemDeleted('route.view')['button']) {
                        if (Permission::routePermission('route.view') && !MenuItem::getMenuItemBlocked('route.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-route" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('route.edit') && MenuItem::getMenuItemDeleted('route.edit')['button']) {
                        if (Permission::routePermission('route.edit') && !MenuItem::getMenuItemBlocked('route.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-route" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('route.ban') && MenuItem::getMenuItemDeleted('route.ban')['button']) {
                        if (Permission::routePermission('route.ban') && !MenuItem::getMenuItemBlocked('route.ban')['button'] && $row->id != 64 && $row->id != 69) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-route" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-route" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        } else {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }
                    }

                    // excluir
                    if (app('router')->has('route.delete') && MenuItem::getMenuItemDeleted('route.delete')['button']) {
                        if (Permission::routePermission('route.delete') && !MenuItem::getMenuItemBlocked('route.delete')['button'] && $row->id != 64 && $row->id != 65 && $row->id != 71) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-route" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['group', 'url', 'route', 'controller', 'route_option', 'view', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('65');
        $page = PageHelpers::page('66');
        $list = PageHelpers::page('67');
        $add  = PageHelpers::page('69');

        return view('layout.routes.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewRouteRequest $request
     * @return JsonResponse
     */
    public function store(NewRouteRequest $request)
    {
        $collection = Route::create([
            'group_id'        => $request->group_id_new_route,
            'route_option_id' => $request->route_option_id_new_route,
            'view'            => $request->has('view_new_route') ? 1 : 0,
            'url'             => $request->url_new_route,
            'route'           => $request->route_new_route,
            'controller'      => $request->controller_new_route,
            'description'     => $request->description_new_route
        ]);

        Permission::create([
            'user_id'  => auth()->user()['id'],
            'route_id' => $collection->id
        ]);

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-bookmark', 'Rota criada com sucesso.');

        return response()->json($data);
    }

    /**
     * Mostrar o formulário para editar o recurso especificado.
     *
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $collection = Route::withTrashed()
            ->select('routes.*', 'groups.name as group', 'route_options.name as type')
            ->leftJoin('groups', 'groups.id', '=', 'routes.group_id')
            ->leftJoin('route_options', 'route_options.id', '=', 'routes.route_option_id')
            ->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditRouteRequest $request
     * @return JsonResponse
     */
    public function update(EditRouteRequest $request)
    {
        $collection = Route::find($request->id_edit_route);

        // dados
        $collection->fill([
            'group_id'        => $request->group_id_edit_route,
            'route_option_id' => $request->route_option_id_edit_route,
            'view'            => $request->has('view_edit_route') ? 1 : 0,
            'url'             => $request->url_edit_route,
            'route'           => $request->route_edit_route,
            'controller'      => $request->controller_edit_route,
            'description'     => $request->description_edit_route
        ])->save();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-check', 'Rota atualizado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockRouteRequest $request
     * @return JsonResponse
     */
    public function block(BlockRouteRequest $request)
    {
        $collection = Route::find($request->id_block_route);

        // impede o bloqueio da rota de rotas
        if ($collection->id == 64 || $collection->id == 69) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode bloquer esta rota.<br><small><b>motivo: </b>ao bloquear esta rota não será mais possível o controle sobre as rotas do sistema.</small>');
            return response()->json($data);
        }

        if ($request->blocked_block_route) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Rota bloqueada com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Rota desbloqueada com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteRouteRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteRouteRequest $request)
    {
        $collection = Route::find($request->id_delete_route);

        // impede a exclusão da rota de rotas
        if ($collection->id == 64 || $collection->id == 65 || $collection->id == 71) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode excluir esta rota.<br><small><b>motivo: </b>ao excluir esta rota não será mais possível o controle sobre as rotas do sistema.</small>');
            return response()->json($data);
        }

        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Rota deletada com sucesso.');

        return response()->json($data);
    }

    /**
     * Exibir uma listagem do recurso.
     *
     * @param Request $request
     * @return Factory|JsonResponse|View|mixed
     * @throws Exception
     */
    public function listDeleted(Request $request)
    {
        // impede o acesso não autorizado
        if (Company::id() != 1) {
            if ($request->ajax()) {
                return datatables([])->toJson();
            }

            return view('layout.routes.tables.deleted.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'group asc');

        $collection = Route::query()
            ->onlyTrashed()
            ->select('routes.*', 'groups.name as group', 'route_options.name as type')
            ->join('groups', 'groups.id', 'routes.group_id')
            ->join('route_options', 'route_options.id', 'routes.route_option_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('groups.name', 'like', '%' . $search . '%')
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('route', 'like', '%' . $search . '%')
                    ->orWhere('controller', 'like', '%' . $search . '%')
                    ->orWhere('route_options.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna grupo
                ->addColumn('group', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->getGroup['name'] . '" title="' . $row->getGroup['description'] . '">' . $row->getGroup['name'] . '</span>';
                })
                // coluna url
                ->addColumn('url', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->url . '" title="' . $row->description . '">' . $row->url . '</span>';
                })
                // coluna rota
                ->addColumn('route', function ($row) {
                    return $row->route;
                })
                // coluna controle
                ->addColumn('controller', function ($row) {
                    return $row->controller;
                })
                // coluna opção da rota
                ->addColumn('route_option', function ($row) {
                    return $row->getRouteOption['name'];
                })
                // coluna página
                ->addColumn('view', function ($row) {
                    if ($row->view == 1) {
                        return '<i class="far fa-check-square"><span class="fe-print">Sim</span></i>';
                    } else {
                        return '<span class="fe-print">Não</span>';
                    }
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('route.view') && MenuItem::getMenuItemDeleted('route.view')['button']) {
                        if (Permission::routePermission('route.view') && !MenuItem::getMenuItemBlocked('route.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-route" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('route.recover') && MenuItem::getMenuItemDeleted('route.recover')['button']) {
                        if (Permission::routePermission('route.recover') && !MenuItem::getMenuItemBlocked('route.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-route" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['group', 'url', 'route', 'controller', 'route_option', 'view', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('65');
        $page = PageHelpers::page('67');
        $list = PageHelpers::page('66');
        $add  = PageHelpers::page('69');

        return view('layout.routes.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverRouteRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverRouteRequest $request)
    {
        Route::onlyTrashed()->find($request->id_recover_route)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Rota recuperada com sucesso.');

        return response()->json($data);
    }
}
