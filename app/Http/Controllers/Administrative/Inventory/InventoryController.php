<?php

namespace App\Http\Controllers\Inventory;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Requests\Inventory\Inventory\DeleteInventoryRequest;
use App\Http\Requests\Inventory\Inventory\EditInventoryRequest;
use App\Http\Requests\Inventory\Inventory\NewInventoryRequest;
use App\Http\Requests\Inventory\Inventory\RecoverInventoryRequest;
use App\Models\Entity\Entity;
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
            ->select('inventories.id as id', 'inventories.image as image', 'inventories.patrimonial_number as patrimonial_number',
                'inventories.name as name', 'inventory_categories.name as category', 'departments.name as department')
            ->join('entities', 'entities.id', '=', 'inventories.entity_id')
            ->join('departments', 'departments.id', '=', 'inventories.department_id')
            ->join('inventory_categories', 'inventory_categories.id', '=', 'inventories.inventory_category_id')
            ->join('inventory_states', 'inventory_states.id', '=', 'inventories.inventory_state_id')
            ->join('voltages', 'voltages.id', '=', 'inventories.voltage_id')
            ->where('departments.entity_id', '=', Entity::id())
            ->where('inventory_categories.entity_id', '=', Entity::id())
            ->where('inventories.entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('inventories.patrimonial_number', 'like', '%' . $search . '%')
                    ->orWhere('inventories.name', 'like', '%' . $search . '%')
                    ->orWhere('inventory_categories.name', 'like', '%' . $search . '%')
                    ->orWhere('departments.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna image
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        $image = '<div class="avatar avatar-sm"><img src="' . url('storage/images/inventories/items/' . $row->image) . '" alt=""></div>';
                    } else {
                        $image = '<div class="avatar avatar-sm"><img src="' . url('images/default/default-image.png') . '" alt=""></div>';
                    }
                    return $image;
                })
                // coluna patrimônio
                ->addColumn('patrimonial_number', function ($row) {
                    return $row->patrimonial_number;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna categoria
                ->addColumn('category', function ($row) {
                    return $row->category;
                })
                // coluna departamento
                ->addColumn('department', function ($row) {
                    return $row->department;
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
                ->rawColumns(['image', 'patrimonial_number', 'name', 'category', 'department', 'action'])
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
        $collection = Inventory::create([
            'entity_id'             => Entity::id(),
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
            'purchase_date'         => FormatHelpers::date_br_to_date($request->purchase_date_new_inventory),
            'warranty_date'         => FormatHelpers::date_br_to_date($request->warranty_date_new_inventory),
            'description'           => $request->description_new_inventory
        ]);

        // upload da imagem
        if ($request->hasFile('image_image_new_inventory') && $request->file('image_image_new_inventory')->isValid()) {
            $file_name = FormatHelpers::image_name($collection->id);
            FileHelpers::destination_file($request, null, 'image_image_new_inventory', $file_name, 'images/inventories/items/');
            $collection->update(['image' => $file_name]);
        }

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
        $collection = Inventory::withTrashed()
            ->select('inventories.*', 'inventory_categories.name as category', 'departments.name as department',
                'inventory_states.name as state', 'voltages.name as voltage')
            ->join('entities', 'entities.id', '=', 'inventories.entity_id')
            ->join('departments', 'departments.id', '=', 'inventories.department_id')
            ->join('inventory_categories', 'inventory_categories.id', '=', 'inventories.inventory_category_id')
            ->join('inventory_states', 'inventory_states.id', '=', 'inventories.inventory_state_id')
            ->join('voltages', 'voltages.id', '=', 'inventories.voltage_id')
            ->where('departments.entity_id', '=', Entity::id())
            ->where('inventory_categories.entity_id', '=', Entity::id())
            ->where('inventories.entity_id', '=', Entity::id())
            ->find($id);

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
        $collection = Inventory::where('entity_id', '=', Entity::id())->find($request->id_edit_inventory);
        $original   = $collection->getOriginal();

        // armazena a imagem
        FileHelpers::destination_file($request, $original['image'], 'image_image_edit_inventory', 'image_edit_inventory', 'images/inventories/items/');

        // dados
        $collection->fill([
            'department_id'         => $request->department_id_edit_inventory,
            'inventory_category_id' => $request->inventory_category_id_edit_inventory,
            'inventory_state_id'    => $request->inventory_state_id_edit_inventory,
            'patrimonial_number'    => $request->patrimonial_number_edit_inventory,
            'name'                  => $request->name_edit_inventory,
            'brand'                 => $request->brand_edit_inventory,
            'model'                 => $request->model_edit_inventory,
            'serial_number'         => $request->serial_number_edit_inventory,
            'invoice'               => $request->invoice_edit_inventory,
            'value'                 => FormatHelpers::to_usd($request->value_edit_inventory),
            'voltage_id'            => $request->voltage_id_edit_inventory,
            'purchase_date'         => FormatHelpers::date_br_to_date($request->purchase_date_edit_inventory),
            'warranty_date'         => FormatHelpers::date_br_to_date($request->warranty_date_edit_inventory),
            'description'           => $request->description_edit_inventory,
            'image'                 => $request->image_edit_inventory
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Item do inventário alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteInventoryRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteInventoryRequest $request)
    {
        $collection = Inventory::where('entity_id', '=', Entity::id())->find($request->id_delete_inventory);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Item do inventário deletado com sucesso.');

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
            ->select('inventories.id as id', 'inventories.image as image', 'inventories.patrimonial_number as patrimonial_number',
                'inventories.name as name', 'inventory_categories.name as category', 'departments.name as department')
            ->join('entities', 'entities.id', '=', 'inventories.entity_id')
            ->join('departments', 'departments.id', '=', 'inventories.department_id')
            ->join('inventory_categories', 'inventory_categories.id', '=', 'inventories.inventory_category_id')
            ->join('inventory_states', 'inventory_states.id', '=', 'inventories.inventory_state_id')
            ->join('voltages', 'voltages.id', '=', 'inventories.voltage_id')
            ->where('departments.entity_id', '=', Entity::id())
            ->where('inventory_categories.entity_id', '=', Entity::id())
            ->where('inventories.entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('inventories.patrimonial_number', 'like', '%' . $search . '%')
                    ->orWhere('inventories.name', 'like', '%' . $search . '%')
                    ->orWhere('inventory_categories.name', 'like', '%' . $search . '%')
                    ->orWhere('departments.name', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna image
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        $image = '<div class="avatar avatar-sm"><img src="' . url('storage/images/inventories/items/' . $row->image) . '" alt=""></div>';
                    } else {
                        $image = '<div class="avatar avatar-sm"><img src="' . url('images/default/default-image.png') . '" alt=""></div>';
                    }
                    return $image;
                })
                // coluna patrimônio
                ->addColumn('patrimonial_number', function ($row) {
                    return $row->patrimonial_number;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna categoria
                ->addColumn('category', function ($row) {
                    return $row->category;
                })
                // coluna departamento
                ->addColumn('department', function ($row) {
                    return $row->department;
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
                ->rawColumns(['image', 'patrimonial_number', 'name', 'category', 'department', 'action'])
                ->toJson();
        }

        return view('inventories.inventories.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverInventoryRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverInventoryRequest $request)
    {
        Inventory::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_inventory)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Item do inventário recuperado com sucesso.');

        return response()->json($data);
    }
}
