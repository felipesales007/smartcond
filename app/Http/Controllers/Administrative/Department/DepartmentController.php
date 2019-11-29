<?php

namespace App\Http\Controllers\Administrative\Department;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Administrative\Department\BlockDepartmentRequest;
use App\Http\Requests\Administrative\Department\DeleteDepartmentRequest;
use App\Http\Requests\Administrative\Department\EditDepartmentRequest;
use App\Http\Requests\Administrative\Department\NewDepartmentRequest;
use App\Http\Requests\Administrative\Department\RecoverDepartmentRequest;
use App\Models\Department;
use App\Models\Entity\Entity;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
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
        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Department::query()
            ->where('entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna nome
                ->addColumn('name', function ($row) {
                    return substr_replace($row->name, (strlen($row->name) > 50 ? '...' : ''), 50);
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return substr_replace($row->description, (strlen($row->description) > 50 ? '...' : ''), 50);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('department.view') && MenuItem::getMenuItemDeleted('department.view')['button']) {
                        if (Permission::routePermission('department.view') && !MenuItem::getMenuItemBlocked('department.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-department" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('department.edit') && MenuItem::getMenuItemDeleted('department.edit')['button']) {
                        if (Permission::routePermission('department.edit') && !MenuItem::getMenuItemBlocked('department.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-department" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('department.ban') && MenuItem::getMenuItemDeleted('department.ban')['button']) {
                        if (Permission::routePermission('department.ban') && !MenuItem::getMenuItemBlocked('department.ban')['button']) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-department" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-department" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        } else {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }
                    }

                    // excluir
                    if (app('router')->has('department.delete') && MenuItem::getMenuItemDeleted('department.delete')['button']) {
                        if (Permission::routePermission('department.delete') && !MenuItem::getMenuItemBlocked('department.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-department" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('department.list');
        $list = PageHelpers::page('department.list.deleted');
        $dash = PageHelpers::page('department.dashboard');
        $add  = PageHelpers::page('department.store');

        return view('administrative.departments.tables.all.page', compact('page', 'list', 'dash', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(NewDepartmentRequest $request)
    {
        // dados
        Department::create([
            'entity_id'   => Entity::id(),
            'name'        => $request->name_new_department,
            'description' => $request->description_new_department,
        ]);

        $data = NotifyHelpers::success_top_center('far fa-building', 'Departamento criado com sucesso.');

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
        $collection = Department::withTrashed()->where('entity_id', '=', Entity::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditDepartmentRequest $request
     * @return JsonResponse
     */
    public function update(EditDepartmentRequest $request)
    {
        $collection = Department::where('entity_id', '=', Entity::id())->find($request->id_edit_department);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_department,
            'description' => $request->description_edit_department,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Departamento alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockDepartmentRequest $request
     * @return JsonResponse
     */
    public function block(BlockDepartmentRequest $request)
    {
        $collection = Department::where('entity_id', '=', Entity::id())->find($request->id_block_department);

        if ($request->blocked_block_department) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Departamento bloqueado com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Departamento desbloqueado com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteDepartmentRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteDepartmentRequest $request)
    {
        $collection = Department::where('entity_id', '=', Entity::id())->find($request->id_delete_department);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Departamento deletado com sucesso.');

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
        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = Department::query()
            ->onlyTrashed()
            ->where('entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna nome
                ->addColumn('name', function ($row) {
                    return substr_replace($row->name, (strlen($row->name) > 50 ? '...' : ''), 50);
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return substr_replace($row->description, (strlen($row->description) > 50 ? '...' : ''), 50);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('department.view') && MenuItem::getMenuItemDeleted('department.view')['button']) {
                        if (Permission::routePermission('department.view') && !MenuItem::getMenuItemBlocked('department.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-department" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('department.recover') && MenuItem::getMenuItemDeleted('department.recover')['button']) {
                        if (Permission::routePermission('department.recover') && !MenuItem::getMenuItemBlocked('department.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-department" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('department.list.deleted');
        $list = PageHelpers::page('department.list');
        $dash = PageHelpers::page('department.dashboard');
        $add  = PageHelpers::page('department.store');

        return view('administrative.departments.tables.deleted.page', compact('page', 'list', 'dash', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverDepartmentRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverDepartmentRequest $request)
    {
        Department::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_department)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Departamento recuperado com sucesso.');

        return response()->json($data);
    }
}
