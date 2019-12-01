<?php

namespace App\Http\Controllers\Layout\Group;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Layout\Group\BlockGroupRequest;
use App\Http\Requests\Layout\Group\DeleteGroupRequest;
use App\Http\Requests\Layout\Group\EditGroupRequest;
use App\Http\Requests\Layout\Group\NewGroupRequest;
use App\Http\Requests\Layout\Group\RecoverGroupRequest;
use App\Models\Company\Company;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use App\Models\Route\Group;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GroupController extends Controller
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

            return view('layout.groups.tables.all.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Group::query()
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('user_level_id', 'like', '%' . $search . '%');
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
                // coluna nível de usuário
                ->addColumn('user_level', function ($row) {
                    return $row->getUserLevel['name'];
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('group.view') && MenuItem::getMenuItemDeleted('group.view')['button']) {
                        if (Permission::routePermission('group.view') && !MenuItem::getMenuItemBlocked('group.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-group" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('group.edit') && MenuItem::getMenuItemDeleted('group.edit')['button']) {
                        if (Permission::routePermission('group.edit') && !MenuItem::getMenuItemBlocked('group.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-group" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('group.ban') && MenuItem::getMenuItemDeleted('group.ban')['button']) {
                        if (Permission::routePermission('group.ban') && !MenuItem::getMenuItemBlocked('group.ban')['button'] && $row->id != 8 || Permission::routePermission('group.ban') && !MenuItem::getMenuItemBlocked('group.ban')['button'] && $row->id != 9) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-group" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-group" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('group.delete') && MenuItem::getMenuItemDeleted('group.delete')['button']) {
                        if (Permission::routePermission('group.delete') && !MenuItem::getMenuItemBlocked('group.delete')['button'] && $row->id != 8 || Permission::routePermission('group.delete') && !MenuItem::getMenuItemBlocked('group.delete')['button'] && $row->id != 9) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-group" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'user_level', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('56');
        $page = PageHelpers::page('57');
        $list = PageHelpers::page('58');
        $add  = PageHelpers::page('60');

        return view('layout.groups.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewGroupRequest $request
     * @return JsonResponse
     */
    public function store(NewGroupRequest $request)
    {
        Group::create([
            'name'           => $request->name_new_group,
            'user_level_id_' => $request->user_level_id_new_group,
            'description'    => $request->description_new_group
        ]);

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-book', 'Grupo criado com sucesso.');

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
        $collection = Group::withTrashed()
            ->select('groups.*', 'user_levels.name as user_level')
            ->join('user_levels', 'user_levels.id', '=', 'groups.user_level_id')
            ->find($id);
        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditGroupRequest $request
     * @return JsonResponse
     */
    public function update(EditGroupRequest $request)
    {
        $collection = Group::find($request->id_edit_group);

        // dados
        $collection->fill([
            'name'           => $request->name_edit_group,
            'user_level_id_' => $request->user_level_id_edit_group,
            'description'    => $request->description_edit_group,
        ])->save();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-check', 'Grupo atualizado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockGroupRequest $request
     * @return JsonResponse
     */
    public function block(BlockGroupRequest $request)
    {
        $collection = Group::find($request->id_block_group);

        // impede o bloqueio do grupo de rotas
        if ($collection->id == 8 || $collection->id == 9) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode bloquer este grupo.<br><small><b>motivo: </b>ao bloquear este grupo não será mais possível o controle sobre os grupos e as rotas do sistema.</small>');
            return response()->json($data);
        }

        if ($request->blocked_block_group) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Grupo bloqueado com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Grupo desbloqueado com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteGroupRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteGroupRequest $request)
    {
        $collection = Group::find($request->id_delete_group);

        // impede a exclusão do grupo de rotas
        if ($collection->id == 8 || $collection->id == 9) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não pode excluir este grupo.<br><small><b>motivo: </b>ao excluir este grupo não será mais possível o controle sobre os grupos e as rotas do sistema.</small>');
            return response()->json($data);
        }

        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Grupo deletado com sucesso.');

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

            return view('layout.groups.tables.deleted.page');
        }

        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Group::query()
            ->onlyTrashed()
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('user_level_id', 'like', '%' . $search . '%');
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
                // coluna nível de usuário
                ->addColumn('user_level', function ($row) {
                    return $row->getUserLevel['name'];
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('group.view') && MenuItem::getMenuItemDeleted('group.view')['button']) {
                        if (Permission::routePermission('group.view') && !MenuItem::getMenuItemBlocked('group.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-group" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('group.recover') && MenuItem::getMenuItemDeleted('group.recover')['button']) {
                        if (Permission::routePermission('group.recover') && !MenuItem::getMenuItemBlocked('group.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-group" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'user_level', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('56');
        $page = PageHelpers::page('58');
        $list = PageHelpers::page('57');
        $add  = PageHelpers::page('60');

        return view('layout.groups.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverGroupRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverGroupRequest $request)
    {
        Group::onlyTrashed()->find($request->id_recover_group)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Grupo recuperado com sucesso.');

        return response()->json($data);
    }
}
