<?php

namespace App\Http\Controllers\Condominium\Service;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Condominium\Service\DeleteServiceRequest;
use App\Http\Requests\Condominium\Service\EditServiceRequest;
use App\Http\Requests\Condominium\Service\NewServiceRequest;
use App\Http\Requests\Condominium\Service\RecoverServiceRequest;
use App\Models\Condominium\CondominiumService;
use App\Models\Entity\Entity;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
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

        $collection = CondominiumService::query()
            ->where('entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('rg', 'like', '%' . $search . '%')
                    ->orWhere('profession', 'like', '%' . $search . '%');
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
                // coluna rg
                ->addColumn('rg', function ($row) {
                    return $row->rg;
                })
                // coluna profession
                ->addColumn('profession', function ($row) {
                    return $row->profession;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.service.view') && MenuItem::getMenuItemDeleted('condominium.service.view')['button']) {
                        if (Permission::routePermission('condominium.service.view') && !MenuItem::getMenuItemBlocked('condominium.service.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-service" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('condominium.service.edit') && MenuItem::getMenuItemDeleted('condominium.service.edit')['button']) {
                        if (Permission::routePermission('condominium.service.edit') && !MenuItem::getMenuItemBlocked('condominium.service.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-condominium-service" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // excluir
                    if (app('router')->has('condominium.service.delete') && MenuItem::getMenuItemDeleted('condominium.service.delete')['button']) {
                        if (Permission::routePermission('condominium.service.delete') && !MenuItem::getMenuItemBlocked('condominium.service.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-condominium-service" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'rg', 'profession', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('142');
        $page = PageHelpers::page('143');
        $list = PageHelpers::page('144');
        $add  = PageHelpers::page('146');

        return view('condominium.services.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewServiceRequest $request
     * @return JsonResponse
     */
    public function store(NewServiceRequest $request)
    {
        // dados
        CondominiumService::create([
            'entity_id'  => Entity::id(),
            'name'       => $request->name_new_condominium_service,
            'rg'         => $request->rg_new_condominium_service,
            'contact'    => $request->contact_new_condominium_service,
            'profession' => $request->profession_new_condominium_service,
            'note'       => $request->note_new_condominium_service,
        ]);

        $data = NotifyHelpers::success_top_center('fas fa-wrench', 'Prestador de serviço criado com sucesso.');

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
        $collection = CondominiumService::withTrashed()->where('entity_id', '=', Entity::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditServiceRequest $request
     * @return JsonResponse
     */
    public function update(EditServiceRequest $request)
    {
        $collection = CondominiumService::where('entity_id', '=', Entity::id())->find($request->id_edit_condominium_service);

        // dados
        $collection->fill([
            'name'       => $request->name_edit_condominium_service,
            'rg'         => $request->rg_edit_condominium_service,
            'contact'    => $request->contact_edit_condominium_service,
            'profession' => $request->profession_edit_condominium_service,
            'note'       => $request->note_edit_condominium_service,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Prestador de serviço alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteServiceRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteServiceRequest $request)
    {
        $collection = CondominiumService::where('entity_id', '=', Entity::id())->find($request->id_delete_condominium_service);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Prestador de serviço deletado com sucesso.');

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

        $collection = CondominiumService::query()
            ->onlyTrashed()
            ->where('entity_id', '=', Entity::id())
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('rg', 'like', '%' . $search . '%')
                    ->orWhere('profession', 'like', '%' . $search . '%');
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
                // coluna rg
                ->addColumn('rg', function ($row) {
                    return $row->rg;
                })
                // coluna profession
                ->addColumn('profession', function ($row) {
                    return $row->profession;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('condominium.service.view') && MenuItem::getMenuItemDeleted('condominium.service.view')['button']) {
                        if (Permission::routePermission('condominium.service.view') && !MenuItem::getMenuItemBlocked('condominium.service.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-service" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('condominium.service.recover') && MenuItem::getMenuItemDeleted('condominium.service.recover')['button']) {
                        if (Permission::routePermission('condominium.service.recover') && !MenuItem::getMenuItemBlocked('condominium.service.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-condominium-service" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'rg', 'profession', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('142');
        $page = PageHelpers::page('144');
        $list = PageHelpers::page('143');
        $add  = PageHelpers::page('146');

        return view('condominium.services.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverServiceRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverServiceRequest $request)
    {
        CondominiumService::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_condominium_service)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Prestador de serviço recuperado com sucesso.');

        return response()->json($data);
    }
}
