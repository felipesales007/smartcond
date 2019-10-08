<?php

namespace App\Http\Controllers\Inventory;

use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Requests\Inventory\Inventory\EditInventoryRequest;
use App\Http\Requests\Inventory\Inventory\NewInventoryRequest;
use App\Models\Company\Company;
use App\Models\Inventory\Inventory;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
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

        $collection = Inventory::query()
            ->select('departments.name as department', 'inventory_categories.name as category',
                'inventory_states.name as state', 'voltages.name as voltage', 'inventories.name as name')
            ->join('companies', 'companies.id', '=', 'inventories.company_id')
            ->join('departments', 'departments.id', '=', 'inventories.department_id')
            ->join('inventory_categories', 'inventory_categories.id', '=', 'inventories.inventory_category_id')
            ->join('inventory_states', 'inventory_states.id', '=', 'inventories.inventory_state_id')
            ->join('voltages', 'voltages.id', '=', 'inventories.voltage_id')
            ->where('departments.company_id', '=', Company::id())
            ->where('inventory_categories.company_id', '=', Company::id())
            ->where('inventories.company_id', '=', Company::id())
            ->where('inventories.name', 'like', '%' . $search . '%')
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna patrimônio
                ->addColumn('patrimonial_number', function ($row) {
                    return $row->name;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('inventory.view') && MenuItem::getMenuItemDeleted('inventory.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-inventory') && !MenuItem::getMenuItemBlocked('inventory.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-inventory" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('inventory.edit') && MenuItem::getMenuItemDeleted('inventory.edit')['list']) {
                        if (Permission::buttonPermission('btn-modal-edit-inventory') && !MenuItem::getMenuItemBlocked('inventory.edit')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-inventory" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('inventory.ban') && MenuItem::getMenuItemDeleted('inventory.ban')['list']) {
                        if (Permission::buttonPermission('btn-modal-block-inventory') && !MenuItem::getMenuItemBlocked('inventory.ban')['list']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-inventory" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-inventory" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('inventory.delete') && MenuItem::getMenuItemDeleted('inventory.delete')['list']) {
                        if (Permission::buttonPermission('btn-modal-delete-inventory') && !MenuItem::getMenuItemBlocked('inventory.delete')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-inventory" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['patrimonial_number', 'name', 'action'])
                ->toJson();
        }

        return view('inventories.inventories.list');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewInventoryRequest $request
     * @return JsonResponse
     */
    public function store(NewInventoryRequest $request)
    {
        // dados
        Inventory::create([
            'company_id'            => Company::id(),
            'department_id'         => $request->department_id_new_inventory,
            'inventory_category_id' => $request->inventory_category_id_new_inventory,
            'inventory_state_id'    => $request->inventory_state_id_new_inventory,
            'patrimonial_number'    => $request->patrimonial_number_new_inventory,
            'name'                  => $request->name_new_inventory,
            'brand'                 => $request->brand_new_inventory,
            'model'                 => $request->model_new_inventory,
            'serial_number'         => $request->serial_number_new_inventory,
            'invoice'               => $request->invoice_new_inventory,
            'value'                 => FormatHelpers::to_usd($request->value_new_inventory),
            'voltage_id'            => $request->voltage_id_new_inventory,
            'purchase_date'         => $request->purchase_date_new_inventory,
            'warranty_date'         => $request->warranty_date_new_inventory,
            'description'           => $request->description_new_inventory
        ]);

        $data = NotifyHelpers::success_top_center('fas fa-dolly-flatbed', 'Item do inventário criado com sucesso.');

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
        $collection = inventory::withTrashed()->where('company_id', '=', Company::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditInventoryRequest $request
     * @return JsonResponse
     */
    public function update(EditInventoryRequest $request)
    {
        $collection = inventory::where('company_id', '=', Company::id())->find($request->id_edit_inventory);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_inventory,
            'description' => $request->description_edit_inventory,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Departamento alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockinventoryRequest $request
     * @return JsonResponse
     */
    public function block(BlockinventoryRequest $request)
    {
        $collection = inventory::where('company_id', '=', Company::id())->find($request->id_block_inventory);

        if ($request->blocked_block_inventory) {
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
     * @param DeleteinventoryRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteinventoryRequest $request)
    {
        $collection = inventory::where('company_id', '=', Company::id())->find($request->id_delete_inventory);
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

        $collection = inventory::query()
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
                    if (app('router')->has('inventory.view') && MenuItem::getMenuItemDeleted('inventory.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-inventory') && !MenuItem::getMenuItemBlocked('inventory.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-inventory" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('inventory.recover') && MenuItem::getMenuItemDeleted('inventory.recover')['list']) {
                        if (Permission::buttonPermission('btn-modal-recover-inventory') && !MenuItem::getMenuItemBlocked('inventory.recover')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-inventory" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        return view('inventorys.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverinventoryRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverinventoryRequest $request)
    {
        inventory::onlyTrashed()->where('company_id', '=', Company::id())->find($request->id_recover_inventory)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Departamento recuperado com sucesso.');

        return response()->json($data);
    }
}
