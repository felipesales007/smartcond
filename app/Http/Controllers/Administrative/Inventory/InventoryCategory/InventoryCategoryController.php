<?php

namespace App\Http\Controllers\Administrative\Inventory\InventoryCategory;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Inventory\InventoryCategory\BlockInventoryCategoryRequest;
use App\Http\Requests\Inventory\InventoryCategory\DeleteInventoryCategoryRequest;
use App\Http\Requests\Inventory\InventoryCategory\EditInventoryCategoryRequest;
use App\Http\Requests\Inventory\InventoryCategory\NewInventoryCategoryRequest;
use App\Http\Requests\Inventory\InventoryCategory\RecoverInventoryCategoryRequest;
use App\Models\Entity\Entity;
use App\Models\Inventory\InventoryCategory;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
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
                    return $row->name;
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('inventory.category.view') && MenuItem::getMenuItemDeleted('inventory.category.view')['button']) {
                        if (Permission::routePermission('inventory.category.view') && !MenuItem::getMenuItemBlocked('inventory.category.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-inventory-category" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('inventory.category.edit') && MenuItem::getMenuItemDeleted('inventory.category.edit')['button']) {
                        if (Permission::routePermission('inventory.category.edit') && !MenuItem::getMenuItemBlocked('inventory.category.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-inventory-category" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('inventory.category.ban') && MenuItem::getMenuItemDeleted('inventory.category.ban')['button']) {
                        if (Permission::routePermission('inventory.category.ban') && !MenuItem::getMenuItemBlocked('inventory.category.ban')['button']) {
                            if ($row->blocked) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-inventory-category" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-inventory-category" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('inventory.category.delete') && MenuItem::getMenuItemDeleted('inventory.category.delete')['button']) {
                        if (Permission::routePermission('inventory.category.delete') && !MenuItem::getMenuItemBlocked('inventory.category.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-inventory-category" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('inventory.category.list');
        $list = PageHelpers::page('inventory.category.list.deleted');
        $dash = PageHelpers::page('inventory.category.dashboard');
        $add  = PageHelpers::page('inventory.category.store');
        $sub  = PageHelpers::page('inventory.list');

        return view('administrative.inventories.inventory-categories.tables.all.page', compact('page', 'list', 'dash', 'add', 'sub'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewInventoryCategoryRequest $request
     * @return JsonResponse
     */
    public function store(NewInventoryCategoryRequest $request)
    {
        // dados
        InventoryCategory::create([
            'entity_id'   => Entity::id(),
            'name'        => $request->name_new_inventory_category,
            'description' => $request->description_new_inventory_category,
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
        $collection = InventoryCategory::withTrashed()->where('entity_id', '=', Entity::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditInventoryCategoryRequest $request
     * @return JsonResponse
     */
    public function update(EditInventoryCategoryRequest $request)
    {
        $collection = InventoryCategory::where('entity_id', '=', Entity::id())->find($request->id_edit_inventory_category);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_inventory_category,
            'description' => $request->description_edit_inventory_category,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Categoria alterada com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockInventoryCategoryRequest $request
     * @return JsonResponse
     */
    public function block(BlockInventoryCategoryRequest $request)
    {
        $collection = InventoryCategory::where('entity_id', '=', Entity::id())->find($request->id_block_inventory_category);

        if ($request->blocked_block_inventory_category) {
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
     * @param DeleteInventoryCategoryRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteInventoryCategoryRequest $request)
    {
        $collection = InventoryCategory::where('entity_id', '=', Entity::id())->find($request->id_delete_inventory_category);
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
                    return $row->name;
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('inventory.category.view') && MenuItem::getMenuItemDeleted('inventory.category.view')['button']) {
                        if (Permission::routePermission('inventory.category.view') && !MenuItem::getMenuItemBlocked('inventory.category.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-inventory-category" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('inventory.category.recover') && MenuItem::getMenuItemDeleted('inventory.category.recover')['button']) {
                        if (Permission::routePermission('inventory.category.recover') && !MenuItem::getMenuItemBlocked('inventory.category.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-inventory-category" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('inventory.category.list.deleted');
        $list = PageHelpers::page('inventory.category.list');
        $dash = PageHelpers::page('inventory.category.dashboard');
        $add  = PageHelpers::page('inventory.category.store');

        return view('administrative.inventories.inventory-categories.tables.deleted.page', compact('page', 'list', 'dash', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverInventoryCategoryRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverInventoryCategoryRequest $request)
    {
        InventoryCategory::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_inventory_category)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Categoria recuperada com sucesso.');

        return response()->json($data);
    }
}
