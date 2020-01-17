<?php

namespace App\Http\Controllers\Condominium\Apartment;

use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Condominium\Apartment\DeleteApartmentRequest;
use App\Http\Requests\Condominium\Apartment\EditApartmentRequest;
use App\Http\Requests\Condominium\Apartment\NewApartmentRequest;
use App\Http\Requests\Condominium\Apartment\RecoverApartmentRequest;
use App\Models\Condominium\CondominiumApartment;
use App\Models\Condominium\CondominiumApartmentParking;
use App\Models\Condominium\CondominiumParking;
use App\Models\Entity\Entity;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ApartmentController extends Controller
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
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'condominium_apartments.name asc');

        $collection = CondominiumApartment::query()
            ->select('condominium_apartments.*', 'condominium_blocks.name as block')
            ->leftJoin('condominium_blocks', 'condominium_blocks.id', '=', 'condominium_apartments.block_id')
            ->where('condominium_apartments.entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('condominium_apartments.name', 'like', '%' . $search . '%')
                    ->orWhere('condominium_blocks.name', 'like', '%' . $search . '%');
            })
            ->orderByRaw('length(' . $order[0] . ')' . $order[1])
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna bloco
                ->addColumn('block', function ($row) {
                    return $row->block;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna estacionamento
                ->addColumn('parking', function ($row) {
                    $parking = CondominiumApartmentParking::join('condominium_parkings', 'condominium_parkings.id', '=', 'condominium_apartment_parkings.parking_id')
                        ->where('apartment_id', '=', $row->id)
                        ->get()
                        ->pluck('name')
                        ->toArray();

                    if (!$parking) {
                        return null;
                    }

                    $array = null;
                    for ($i = 0; $i < count($parking); $i++) {
                        $array[] = '<span class="badge badge-info"><i class="fas fa-car mr-1"></i>' . $parking[$i] . '</span>';
                    }

                    return implode(' ', $array);
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return FormatHelpers::limiter($row->description);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.apartment.view') && MenuItem::getMenuItemDeleted('condominium.apartment.view')['button']) {
                        if (Permission::routePermission('condominium.apartment.view') && !MenuItem::getMenuItemBlocked('condominium.apartment.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-apartment" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('condominium.apartment.edit') && MenuItem::getMenuItemDeleted('condominium.apartment.edit')['button']) {
                        if (Permission::routePermission('condominium.apartment.edit') && !MenuItem::getMenuItemBlocked('condominium.apartment.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-condominium-apartment" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // excluir
                    if (app('router')->has('condominium.apartment.delete') && MenuItem::getMenuItemDeleted('condominium.apartment.delete')['button']) {
                        if (Permission::routePermission('condominium.apartment.delete') && !MenuItem::getMenuItemBlocked('condominium.apartment.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-condominium-apartment" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['block', 'name', 'parking', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('134');
        $page = PageHelpers::page('135');
        $list = PageHelpers::page('136');
        $add  = PageHelpers::page('138');

        return view('condominium.apartments.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewApartmentRequest $request
     * @return JsonResponse
     */
    public function store(NewApartmentRequest $request)
    {
        // dados
        $collection = CondominiumApartment::create([
            'entity_id'   => Entity::id(),
            'block_id'    => $request->block_id_new_condominium_apartment,
            'name'        => $request->name_new_condominium_apartment,
            'description' => $request->description_new_condominium_apartment,
        ]);

        for ($i = 0; $i < count($request->parking_id_new_condominium_apartment); $i++) {
            CondominiumApartmentParking::create([
                'apartment_id' => $collection->id,
                'parking_id'   => $request->parking_id_new_condominium_apartment[$i]
            ]);
        }

        $data = NotifyHelpers::success_top_center('fas fa-building', 'Apartamento criado com sucesso.');

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
        $select_parking = CondominiumApartmentParking::join('condominium_parkings', 'condominium_parkings.id', 'condominium_apartment_parkings.parking_id')
        ->where('apartment_id', '=', $id)
        ->get()
        ->pluck('parking_id')
        ->toArray();

        $array_parking = CondominiumApartmentParking::select('name')
            ->join('condominium_parkings', 'condominium_parkings.id', 'condominium_apartment_parkings.parking_id')
            ->where('apartment_id', '=', $id)
            ->orderBy('condominium_parkings.id')
            ->get()
            ->toArray();

        $collection = CondominiumApartment::withTrashed()
            ->select('condominium_apartments.*', 'condominium_blocks.name as block')
            ->leftJoin('condominium_blocks', 'condominium_blocks.id', '=', 'condominium_apartments.block_id')
            ->where('condominium_apartments.entity_id', '=', Entity::id())
            ->find($id);

        $collection = Arr::add($collection, 'parking', $array_parking);
        $collection = Arr::add($collection, 'parking_id', $select_parking);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditApartmentRequest $request
     * @return JsonResponse
     */
    public function update(EditApartmentRequest $request)
    {
        $collection = CondominiumApartment::where('entity_id', '=', Entity::id())->find($request->id_edit_condominium_apartment);

        $parking = CondominiumApartmentParking::where('apartment_id', '=', $request->id_edit_condominium_apartment)
            ->orderByRaw('length(parking_id) asc')
            ->orderBy('parking_id', 'asc')
            ->get()
            ->pluck('parking_id')
            ->toArray();

        // se houver alteração
        if ($request->parking_id_edit_condominium_apartment != $parking) {
            // remove as relações antigas
            CondominiumApartmentParking::where('apartment_id', $request->id_edit_condominium_apartment)
                ->whereIn('parking_id', $parking)
                ->delete();

            // adicona as novas relações
            for ($i = 0; $i < count($request->parking_id_edit_condominium_apartment); $i++) {
                CondominiumApartmentParking::create([
                    'apartment_id' => $request->id_edit_condominium_apartment,
                    'parking_id'   => $request->parking_id_edit_condominium_apartment[$i]
                ]);
            }
        }

        // dados
        $collection->fill([
            'block_id'    => $request->block_id_edit_condominium_apartment,
            'name'        => $request->name_edit_condominium_apartment,
            'description' => $request->description_edit_condominium_apartment,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Apartamento alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteApartmentRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteApartmentRequest $request)
    {
        $collection = CondominiumApartment::where('entity_id', '=', Entity::id())->find($request->id_delete_condominium_apartment);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Apartamento deletado com sucesso.');

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
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'condominium_apartments.name asc');

        $collection = CondominiumApartment::query()
            ->onlyTrashed()
            ->select('condominium_apartments.*', 'condominium_blocks.name as block')
            ->leftJoin('condominium_blocks', 'condominium_blocks.id', '=', 'condominium_apartments.block_id')
            ->where('condominium_apartments.entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('condominium_apartments.name', 'like', '%' . $search . '%')
                    ->orWhere('condominium_blocks.name', 'like', '%' . $search . '%');
            })
            ->orderByRaw('length(' . $order[0] . ')' . $order[1])
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna bloco
                ->addColumn('block', function ($row) {
                    return $row->block;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna estacionamento
                ->addColumn('parking', function ($row) {
                    $parking = CondominiumApartmentParking::join('condominium_parkings', 'condominium_parkings.id', '=', 'condominium_apartment_parkings.parking_id')
                        ->where('apartment_id', '=', $row->id)
                        ->get()
                        ->pluck('name')
                        ->toArray();

                    if (!$parking) {
                        return null;
                    }

                    $array = null;
                    for ($i = 0; $i < count($parking); $i++) {
                        $array[] = '<span class="badge badge-info"><i class="fas fa-car mr-1"></i>' . $parking[$i] . '</span>';
                    }

                    return implode(' ', $array);
                })
                // coluna descrição
                ->addColumn('description', function ($row) {
                    return FormatHelpers::limiter($row->description);
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.apartment.view') && MenuItem::getMenuItemDeleted('condominium.apartment.view')['button']) {
                        if (Permission::routePermission('condominium.apartment.view') && !MenuItem::getMenuItemBlocked('condominium.apartment.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-apartment" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('condominium.apartment.recover') && MenuItem::getMenuItemDeleted('condominium.apartment.recover')['button']) {
                        if (Permission::routePermission('condominium.apartment.recover') && !MenuItem::getMenuItemBlocked('condominium.apartment.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-condominium-apartment" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['block', 'name', 'parking', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('134');
        $page = PageHelpers::page('136');
        $list = PageHelpers::page('135');
        $add  = PageHelpers::page('138');

        return view('condominium.apartments.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverApartmentRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverApartmentRequest $request)
    {
        CondominiumApartment::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_condominium_apartment)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Apartamento recuperado com sucesso.');

        return response()->json($data);
    }

    /**
    * Exibir uma listagem do recurso.
    *
    * @param null $id
    * @return false|string
    */
    public function select($id = null)
    {
        $collection = CondominiumParking::select('condominium_parkings.id', 'condominium_parkings.name')
            ->leftJoin('condominium_apartment_parkings', 'condominium_apartment_parkings.parking_id', '=', 'condominium_parkings.id')
            ->leftJoin('condominium_apartments', 'condominium_apartments.id', '=', 'condominium_apartment_parkings.apartment_id')
            ->where('condominium_parkings.entity_id', '=', Entity::id())
            ->when($id, function ($query) use ($id) {
                $query
                    ->where('condominium_apartments.id', '=', $id)
                    ->orWhere('apartment_id', '=', null);
            })
            ->when(!$id, function ($query) use ($id) {
                $query->where('apartment_id', '=', null);
            })
            ->get();

        return json_encode($collection);
    }
}
