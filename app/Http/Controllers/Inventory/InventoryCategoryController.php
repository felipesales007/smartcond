<?php

namespace App\Http\Controllers\Inventory;

use App\Helpers\NotifyHelpers;
use App\Http\Requests\Category\BlockCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Http\Requests\Category\NewCategoryRequest;
use App\Http\Requests\Category\RecoverCategoryRequest;
use App\Models\Company\Company;
use App\Models\Inventory\InventoryCategory;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryCategoryController extends Controller
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

        $collection = InventoryCategory::query()
            ->where('company_id', '=', Company::id())
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('category.view') && MenuItem::getMenuItemDeleted('category.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-category') && !MenuItem::getMenuItemBlocked('category.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-category" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('category.edit') && MenuItem::getMenuItemDeleted('category.edit')['list']) {
                        if (Permission::buttonPermission('btn-modal-edit-category') && !MenuItem::getMenuItemBlocked('category.edit')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-category" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('category.ban') && MenuItem::getMenuItemDeleted('category.ban')['list']) {
                        if (Permission::buttonPermission('btn-modal-block-category') && !MenuItem::getMenuItemBlocked('category.ban')['list']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-category" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-category" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        } else {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }
                    }

                    // excluir
                    if (app('router')->has('category.delete') && MenuItem::getMenuItemDeleted('category.delete')['list']) {
                        if (Permission::buttonPermission('btn-modal-delete-category') && !MenuItem::getMenuItemBlocked('category.delete')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-category" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        return view('inventories.categories.list');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewCategoryRequest $request
     * @return JsonResponse
     */
    public function store(NewCategoryRequest $request)
    {
        // dados
        InventoryCategory::create([
            'company_id'  => Company::id(),
            'name'        => $request->name_new_category,
            'description' => $request->description_new_category,
        ]);

        $data = NotifyHelpers::success_top_center('fas fa-boxes', 'Categoria criada com sucesso.');

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
        $collection = InventoryCategory::withTrashed()->where('company_id', '=', Company::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditCategoryRequest $request
     * @return JsonResponse
     */
    public function update(EditCategoryRequest $request)
    {
        $collection = InventoryCategory::where('company_id', '=', Company::id())->find($request->id_edit_category);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_category,
            'description' => $request->description_edit_category,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Categoria alterada com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockCategoryRequest $request
     * @return JsonResponse
     */
    public function block(BlockCategoryRequest $request)
    {
        $collection = InventoryCategory::where('company_id', '=', Company::id())->find($request->id_block_category);

        if ($request->blocked_block_category) {
            if (!$collection->blocked) {
                $collection->blocked = now()->toDateTimeString();
                $collection->save();
            }

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Categoria bloqueada com sucesso.');
        } else {
            $collection->blocked = null;
            $collection->save();

            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Categoria desbloqueada com sucesso.');
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteCategoryRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteCategoryRequest $request)
    {
        $collection = InventoryCategory::where('company_id', '=', Company::id())->find($request->id_delete_category);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Categoria deletada com sucesso.');

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

        $collection = InventoryCategory::query()
            ->onlyTrashed()
            ->where('company_id', '=', Company::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%');
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
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('category.view') && MenuItem::getMenuItemDeleted('category.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-category') && !MenuItem::getMenuItemBlocked('category.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-category" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('category.recover') && MenuItem::getMenuItemDeleted('category.recover')['list']) {
                        if (Permission::buttonPermission('btn-modal-recover-category') && !MenuItem::getMenuItemBlocked('category.recover')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-category" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        return view('inventories.categories.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverCategoryRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverCategoryRequest $request)
    {
        InventoryCategory::onlyTrashed()->where('company_id', '=', Company::id())->find($request->id_recover_category)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Categoria recuperada com sucesso.');

        return response()->json($data);
    }
}
