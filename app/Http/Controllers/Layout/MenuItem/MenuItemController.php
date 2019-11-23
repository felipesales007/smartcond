<?php

namespace App\Http\Controllers\Layout\MenuItem;

use App\Helpers\NotifyHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Layout\MenuItem\BlockMenuItemRequest;
use App\Http\Requests\Layout\MenuItem\DeleteMenuItemRequest;
use App\Http\Requests\Layout\MenuItem\EditMenuItemRequest;
use App\Http\Requests\Layout\MenuItem\NewMenuItemRequest;
use App\Http\Requests\Layout\MenuItem\RecoverMenuItemRequest;
use App\Models\Company\Company;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use App\Models\Route\Group;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuItemController extends Controller
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

            return view('layout.menu-items.tables.all.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = MenuItem::query()
            ->select('menu_items.*', 'menu.name as menu', 'routes.route as route', 'groups.name as group')
            ->join('menu', 'menu.id', 'menu_items.menu_id')
            ->join('routes', 'routes.id', 'menu_items.route_id')
            ->join('groups', 'groups.id', 'routes.group_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('menu_items.name', 'like', '%' . $search . '%')
                    ->orWhere('menu.name', 'like', '%' . $search . '%')
                    ->orWhere('groups.name', 'like', '%' . $search . '%')
                    ->orWhere('routes.route', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna menu
                ->addColumn('menu', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->menu . '" title="' . $row->getMenu['description'] . '">' . $row->menu . '</span>';
                })
                // coluna grupo
                ->addColumn('group', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->group . '" title="' . Group::getGroup($row->getRoute['group_id'])['description'] . '">' . $row->group . '</span>';
                })
                // coluna rota
                ->addColumn('route', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->route . '" title="' . $row->getRoute['description'] . '">' . $row->route . '</span>';
                })
                // coluna botão
                ->addColumn('button', function ($row) {
                    if ($row->button) {
                        return '<i class="far fa-window-restore fe-mouse" data-toggle="tooltip" data-placement="top" title="' . $row->button . '"><span class="fe-print">' . $row->button . '</span></i>';
                    } else {
                        return '';
                    }
                })
                // coluna principal
                ->addColumn('main', function ($row) {
                    if ($row->main == 1) {
                        return '<i class="far fa-check-square"><span class="fe-print">Sim</span></i>';
                    } else {
                        return '<span class="fe-print">Não</span>';
                    }
                })
                // coluna visível
                ->addColumn('hidden', function ($row) {
                    if ($row->hidden == 1) {
                        return '<i class="far fa-eye-slash"><span class="fe-print">Não</span></i>';
                    } else {
                        return '<i class="far fa-eye"><span class="fe-print">Sim</span></i>';
                    }
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('menu.item.view') && MenuItem::getMenuItemDeleted('menu.item.view')['button']) {
                        if (Permission::routePermission('menu.item.view') && !MenuItem::getMenuItemBlocked('menu.item.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-menu-item" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('menu.item.edit') && MenuItem::getMenuItemDeleted('menu.item.edit')['button']) {
                        if (Permission::routePermission('menu.item.edit') && !MenuItem::getMenuItemBlocked('menu.item.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-menu-item" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('menu.item.ban') && MenuItem::getMenuItemDeleted('menu.item.ban')['button']) {
                        if (Permission::routePermission('menu.item.ban') && !MenuItem::getMenuItemBlocked('menu.item.ban')['button'] && $row->id != 84 && $row->id != 89) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-menu-item" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-menu-item" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('menu.item.delete') && MenuItem::getMenuItemDeleted('menu.item.delete')['button']) {
                        if (Permission::routePermission('menu.item.delete') && !MenuItem::getMenuItemBlocked('menu.item.delete')['button'] && $row->id != 84 && $row->id != 83 && $row->id != 91) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-menu-item" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'menu', 'group', 'route', 'button', 'main', 'hidden', 'action'])
                ->toJson();
        }

        return view('layout.menu-items.tables.all.page');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewMenuItemRequest $request
     * @return JsonResponse
     */
    public function store(NewMenuItemRequest $request)
    {
        MenuItem::create([
            'menu_id'     => $request->menu_id_new_menu_item,
            'route_id'    => $request->route_id_new_menu_item,
            'name'        => $request->name_new_menu_item,
            'order'       => $request->order_new_menu_item,
            'button'      => $request->button_new_menu_item,
            'main'        => $request->has('main_new_menu_item') ? 1 : 0,
            'hidden'      => $request->has('hidden_new_menu_item') ? 1 : 0,
            'description' => $request->description_new_menu_item
        ]);

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-genderless', 'Item do menu criado com sucesso.');

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
        $collection = MenuItem::withTrashed()
            ->select('menu_items.*', 'menu.name as menu', 'menu.description as menu_description', 'routes.url as url',
                'routes.route as route', 'routes.view as view', 'groups.name as group', 'groups.description as group_description')
            ->leftJoin('menu', 'menu.id', '=', 'menu_items.menu_id')
            ->leftJoin('routes', 'routes.id', '=', 'menu_items.route_id')
            ->leftJoin('groups', 'groups.id', '=', 'routes.group_id')
            ->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditMenuItemRequest $request
     * @return JsonResponse
     */
    public function update(EditMenuItemRequest $request)
    {
        $collection = MenuItem::find($request->id_edit_menu_item);

        // dados
        $collection->fill([
            'menu_id'     => $request->menu_id_edit_menu_item,
            'route_id'    => $request->route_id_edit_menu_item,
            'name'        => $request->name_edit_menu_item,
            'order'       => $request->order_edit_menu_item,
            'button'      => $request->button_edit_menu_item,
            'main'        => $request->has('main_edit_menu_item') ? 1 : 0,
            'hidden'      => $request->has('hidden_edit_menu_item') ? 1 : 0,
            'description' => $request->description_edit_menu_item
        ])->save();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-check', 'Item do menu atualizado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockMenuItemRequest $request
     * @return JsonResponse
     */
    public function block(BlockMenuItemRequest $request)
    {
        $collection = MenuItem::find($request->id_block_menu_item);

        // impede o bloqueio de itens do menu
        if ($collection->id == 84 || $collection->id == 89) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode bloquer a lista de itens do menu.<br><small><b>motivo: </b>ao bloquear este item do menu não será mais possível o controle sobre os itens do menu no sistema.</small>');
            return response()->json($data);
        }

        if ($request->blocked_block_menu_item) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Item do menu bloqueado com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Item do menu desbloqueado com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteMenuItemRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteMenuItemRequest $request)
    {
        $collection = MenuItem::find($request->id_delete_menu_item);

        // impede a exclusão de itens do menu
        if ($collection->id == 84 || $collection->id == 83 || $collection->id == 91) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode excluir a lista de itens do menu.<br><small><b>motivo: </b>ao excluir este item do menu não será mais possível o controle sobre os itens do menu no sistema.</small>');
            return response()->json($data);
        }

        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Item do menu deletado com sucesso.');

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

            return view('layout.menu-items.tables.deleted.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = MenuItem::query()
            ->onlyTrashed()
            ->select('menu_items.*', 'menu.name as menu', 'routes.route as route', 'groups.name as group')
            ->join('menu', 'menu.id', 'menu_items.menu_id')
            ->join('routes', 'routes.id', 'menu_items.route_id')
            ->join('groups', 'groups.id', 'routes.group_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('menu_items.name', 'like', '%' . $search . '%')
                    ->orWhere('menu.name', 'like', '%' . $search . '%')
                    ->orWhere('groups.name', 'like', '%' . $search . '%')
                    ->orWhere('routes.route', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna menu
                ->addColumn('menu', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->menu . '" title="' . $row->getMenu['description'] . '">' . $row->menu . '</span>';
                })
                // coluna grupo
                ->addColumn('group', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->group . '" title="' . Group::getGroup($row->getRoute['group_id'])['description'] . '">' . $row->group . '</span>';
                })
                // coluna rota
                ->addColumn('route', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->route . '" title="' . $row->getRoute['description'] . '">' . $row->route . '</span>';
                })
                // coluna botão
                ->addColumn('button', function ($row) {
                    if ($row->button) {
                        return '<i class="far fa-window-restore fe-mouse" data-toggle="tooltip" data-placement="top" title="' . $row->button . '"><span class="fe-print">' . $row->button . '</span></i>';
                    } else {
                        return '';
                    }
                })
                // coluna principal
                ->addColumn('main', function ($row) {
                    if ($row->main == 1) {
                        return '<i class="far fa-check-square"><span class="fe-print">Sim</span></i>';
                    } else {
                        return '<span class="fe-print">Não</span>';
                    }
                })
                // coluna visível
                ->addColumn('hidden', function ($row) {
                    if ($row->hidden == 1) {
                        return '<i class="far fa-eye-slash"><span class="fe-print">Não</span></i>';
                    } else {
                        return '<i class="far fa-eye"><span class="fe-print">Sim</span></i>';
                    }
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('menu.item.view') && MenuItem::getMenuItemDeleted('menu.item.delete')['button']) {
                        if (Permission::routePermission('menu.item.view') && !MenuItem::getMenuItemBlocked('menu.item.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-menu-item" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('menu.item.recover') && MenuItem::getMenuItemDeleted('menu.item.delete')['button']) {
                        if (Permission::routePermission('menu.item.recover') && !MenuItem::getMenuItemBlocked('menu.item.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-menu-item" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'menu', 'group', 'route', 'button', 'main', 'hidden', 'action'])
                ->toJson();
        }

        return view('layout.menu-items.tables.deleted.page');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverMenuItemRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverMenuItemRequest $request)
    {
        MenuItem::onlyTrashed()->find($request->id_recover_menu_item)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Item do menu recuperado com sucesso.');

        return response()->json($data);
    }
}
