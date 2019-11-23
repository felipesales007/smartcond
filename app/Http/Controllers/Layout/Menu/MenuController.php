<?php

namespace App\Http\Controllers\Layout\Menu;

use App\Helpers\NotifyHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Layout\Menu\BlockMenuRequest;
use App\Http\Requests\Layout\Menu\DeleteMenuRequest;
use App\Http\Requests\Layout\Menu\EditMenuRequest;
use App\Http\Requests\Layout\Menu\NewMenuRequest;
use App\Http\Requests\Layout\Menu\RecoverMenuRequest;
use App\Models\Company\Company;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
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

            return view('layout.menu.tables.all.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Menu::query()
            ->select('menu.*', 'menu_options.name as type')
            ->join('menu_options', 'menu_options.id', 'menu.menu_option_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('menu.name', 'like', '%' . $search . '%')
                    ->orWhere('menu_options.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna ícone
                ->addColumn('icon', function ($row) {
                    return '<i class="' . $row->icon . ' ' . $row->getColor['color'] . '"></i>';
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna tipo
                ->addColumn('type', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->getMenuOption['name'] . '" title="' . $row->getMenuOption['description'] . '">' . $row->getMenuOption['name'] . '</span>';
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
                    if (app('router')->has('menu.view') && MenuItem::getMenuItemDeleted('menu.view')['button']) {
                        if (Permission::routePermission('menu.view') && !MenuItem::getMenuItemBlocked('menu.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-menu" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('menu.edit') && MenuItem::getMenuItemDeleted('menu.edit')['button']) {
                        if (Permission::routePermission('menu.edit') && !MenuItem::getMenuItemBlocked('menu.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-menu" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('menu.ban') && MenuItem::getMenuItemDeleted('menu.ban')['button']) {
                        if (Permission::routePermission('menu.ban') && !MenuItem::getMenuItemBlocked('menu.ban')['button'] && $row->id != 7) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-menu" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-menu" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('menu.delete') && MenuItem::getMenuItemDeleted('menu.delete')['button']) {
                        if (Permission::routePermission('menu.delete') && !MenuItem::getMenuItemBlocked('menu.delete')['button'] && $row->id != 7) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-menu" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['icon', 'name', 'type', 'hidden', 'action'])
                ->toJson();
        }

        return view('layout.menu.tables.all.page');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewMenuRequest $request
     * @return JsonResponse
     */
    public function store(NewMenuRequest $request)
    {
        Menu::create([
            'group_id'       => $request->group_id_new_menu,
            'menu_option_id' => $request->menu_option_id_new_menu,
            'name'           => $request->name_new_menu,
            'icon'           => $request->icon_new_menu,
            'color_id'       => $request->color_id_new_menu,
            'order'          => $request->order_new_menu,
            'hidden'         => $request->has('hidden_new_menu') ? 1 : 0,
            'description'    => $request->description_new_menu
        ]);

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-list-ul', 'Menu criada com sucesso.');

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
        $collection = Menu::withTrashed()
            ->select('menu.*', 'colors.color as color', 'colors.name as color_name',
                'menu_options.name as type', 'menu_options.description as type_description', 'groups.name as group')
            ->join('colors', 'colors.id', '=', 'menu.color_id')
            ->join('menu_options', 'menu_options.id', '=', 'menu.menu_option_id')
            ->leftJoin('menu_items', 'menu_items.menu_id', 'menu.id')
            ->leftJoin('routes', 'routes.id', 'menu_items.route_id')
            ->leftJoin('groups', 'groups.id', 'routes.group_id')
            ->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditMenuRequest $request
     * @return JsonResponse
     */
    public function update(EditMenuRequest $request)
    {
        $collection = Menu::find($request->id_edit_menu);

        // dados
        $collection->fill([
            'group_id'       => $request->group_id_edit_menu,
            'menu_option_id' => $request->menu_option_id_edit_menu,
            'name'           => $request->name_edit_menu,
            'icon'           => $request->icon_edit_menu,
            'color_id'       => $request->color_id_edit_menu,
            'order'          => $request->order_edit_menu,
            'hidden'         => $request->has('hidden_edit_menu') ? 1 : 0,
            'description'    => $request->description_edit_menu
        ])->save();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-check', 'Menu atualizado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockMenuRequest $request
     * @return JsonResponse
     */
    public function block(BlockMenuRequest $request)
    {
        $collection = Menu::find($request->id_block_menu);

        // impede o bloqueio do menu de menu
        if ($collection->id == 7) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode bloquer este menu.<br><small><b>motivo: </b>ao bloquear este menu não será mais possível o controle sobre os menu do sistema.</small>');
            return response()->json($data);
        }

        if ($request->blocked_block_menu) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Menu bloqueado com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Menu desbloqueado com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteMenuRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteMenuRequest $request)
    {
        $collection = Menu::find($request->id_delete_menu);

        // impede a exclusão do menu de menu
        if ($collection->id == 7) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode excluir este menu.<br><small><b>motivo: </b>ao excluir este menu não será mais possível o controle sobre os menu do sistema.</small>');
            return response()->json($data);
        }

        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Menu deletado com sucesso.');

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

            return view('layout.menu.tables.deleted.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Menu::query()
            ->onlyTrashed()
            ->select('menu.*', 'menu_options.name as type')
            ->join('menu_options', 'menu_options.id', 'menu.menu_option_id')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('menu.name', 'like', '%' . $search . '%')
                    ->orWhere('menu_options.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna ícone
                ->addColumn('icon', function ($row) {
                    return '<i class="' . $row->icon . ' ' . $row->getColor['color'] . '"></i>';
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna tipo
                ->addColumn('type', function ($row) {
                    return '<span class="fe-mouse" data-toggle="tooltip" data-placement="top" data-value="' . $row->getMenuOption['name'] . '" title="' . $row->getMenuOption['description'] . '">' . $row->getMenuOption['name'] . '</span>';
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
                    if (app('router')->has('menu.view') && MenuItem::getMenuItemDeleted('menu.view')['button']) {
                        if (Permission::routePermission('menu.view') && !MenuItem::getMenuItemBlocked('menu.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-menu" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('menu.recover') && MenuItem::getMenuItemDeleted('menu.recover')['button']) {
                        if (Permission::routePermission('menu.recover') && !MenuItem::getMenuItemBlocked('menu.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-menu" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['icon', 'name', 'type', 'hidden', 'action'])
                ->toJson();
        }

        return view('layout.menu.tables.deleted.page');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverMenuRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverMenuRequest $request)
    {
        Menu::onlyTrashed()->find($request->id_recover_menu)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Menu recuperado com sucesso.');

        return response()->json($data);
    }
}
