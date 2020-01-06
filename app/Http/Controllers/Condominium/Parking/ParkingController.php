<?php

namespace App\Http\Controllers\Condominium\Parking;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Condominium\Parking\DeleteParkingRequest;
use App\Http\Requests\Condominium\Parking\EditParkingRequest;
use App\Http\Requests\Condominium\Parking\NewParkingRequest;
use App\Http\Requests\Condominium\Parking\RecoverParkingRequest;
use App\Models\Condominium\CondominiumParking;
use App\Models\Entity\Entity;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParkingController extends Controller
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

        $collection = CondominiumParking::query()
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
                    return substr_replace($row->description, (strlen($row->description) > 50 ? '...' : ''), 50);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.parking.view') && MenuItem::getMenuItemDeleted('condominium.parking.view')['button']) {
                        if (Permission::routePermission('condominium.parking.view') && !MenuItem::getMenuItemBlocked('condominium.parking.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-parking" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('condominium.parking.edit') && MenuItem::getMenuItemDeleted('condominium.parking.edit')['button']) {
                        if (Permission::routePermission('condominium.parking.edit') && !MenuItem::getMenuItemBlocked('condominium.parking.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-condominium-parking" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // excluir
                    if (app('router')->has('condominium.parking.delete') && MenuItem::getMenuItemDeleted('condominium.parking.delete')['button']) {
                        if (Permission::routePermission('condominium.parking.delete') && !MenuItem::getMenuItemBlocked('condominium.parking.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-condominium-parking" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('126');
        $page = PageHelpers::page('127');
        $list = PageHelpers::page('128');
        $add  = PageHelpers::page('130');

        return view('condominium.parkings.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewParkingRequest $request
     * @return JsonResponse
     */
    public function store(NewParkingRequest $request)
    {
        // dados
        CondominiumParking::create([
            'entity_id'   => Entity::id(),
            'name'        => $request->name_new_condominium_parking,
            'description' => $request->description_new_condominium_parking,
        ]);

        $data = NotifyHelpers::success_top_center('fas fa-car', 'Estacionamento criado com sucesso.');

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
        $collection = CondominiumParking::withTrashed()->where('entity_id', '=', Entity::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditParkingRequest $request
     * @return JsonResponse
     */
    public function update(EditParkingRequest $request)
    {
        $collection = CondominiumParking::where('entity_id', '=', Entity::id())->find($request->id_edit_condominium_parking);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_condominium_parking,
            'description' => $request->description_edit_condominium_parking,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Estacionamento alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteParkingRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteParkingRequest $request)
    {
        $collection = CondominiumParking::where('entity_id', '=', Entity::id())->find($request->id_delete_condominium_parking);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Estacionamento deletado com sucesso.');

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

        $collection = CondominiumParking::query()
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
                    return substr_replace($row->description, (strlen($row->description) > 50 ? '...' : ''), 50);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.parking.view') && MenuItem::getMenuItemDeleted('condominium.parking.view')['button']) {
                        if (Permission::routePermission('condominium.parking.view') && !MenuItem::getMenuItemBlocked('condominium.parking.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-parking" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('condominium.parking.recover') && MenuItem::getMenuItemDeleted('condominium.parking.recover')['button']) {
                        if (Permission::routePermission('condominium.parking.recover') && !MenuItem::getMenuItemBlocked('condominium.parking.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-condominium-parking" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('126');
        $page = PageHelpers::page('128');
        $list = PageHelpers::page('127');
        $add  = PageHelpers::page('130');

        return view('condominium.parkings.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverParkingRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverParkingRequest $request)
    {
        CondominiumParking::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_condominium_parking)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Estacionamento recuperado com sucesso.');

        return response()->json($data);
    }
}
