<?php

namespace App\Http\Controllers\Condominium\Block;

use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Condominium\Block\DeleteBlockRequest;
use App\Http\Requests\Condominium\Block\EditBlockRequest;
use App\Http\Requests\Condominium\Block\NewBlockRequest;
use App\Http\Requests\Condominium\Block\RecoverBlockRequest;
use App\Models\Condominium\CondominiumBlock;
use App\Models\Entity\Entity;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlockController extends Controller
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

        $collection = CondominiumBlock::query()
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
                    if (app('router')->has('condominium.block.view') && MenuItem::getMenuItemDeleted('condominium.block.view')['button']) {
                        if (Permission::routePermission('condominium.block.view') && !MenuItem::getMenuItemBlocked('condominium.block.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-block" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('condominium.block.edit') && MenuItem::getMenuItemDeleted('condominium.block.edit')['button']) {
                        if (Permission::routePermission('condominium.block.edit') && !MenuItem::getMenuItemBlocked('condominium.block.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-condominium-block" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // excluir
                    if (app('router')->has('condominium.block.delete') && MenuItem::getMenuItemDeleted('condominium.block.delete')['button']) {
                        if (Permission::routePermission('condominium.block.delete') && !MenuItem::getMenuItemBlocked('condominium.block.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-condominium-block" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('92');
        $page = PageHelpers::page('93');
        $list = PageHelpers::page('94');
        $add  = PageHelpers::page('96');

        return view('condominium.blocks.tables.all.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewBlockRequest $request
     * @return JsonResponse
     */
    public function store(NewBlockRequest $request)
    {
        // dados
        CondominiumBlock::create([
            'entity_id'   => Entity::id(),
            'name'        => $request->name_new_condominium_block,
            'description' => $request->description_new_condominium_block,
        ]);

        $data = NotifyHelpers::success_top_center('fas fa-th', 'Bloco criado com sucesso.');

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
        $collection = CondominiumBlock::withTrashed()->where('entity_id', '=', Entity::id())->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditBlockRequest $request
     * @return JsonResponse
     */
    public function update(EditBlockRequest $request)
    {
        $collection = CondominiumBlock::where('entity_id', '=', Entity::id())->find($request->id_edit_condominium_block);

        // dados
        $collection->fill([
            'name'        => $request->name_edit_condominium_block,
            'description' => $request->description_edit_condominium_block,
        ])->save();

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Bloco alterado com sucesso.');

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteBlockRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteBlockRequest $request)
    {
        $collection = CondominiumBlock::where('entity_id', '=', Entity::id())->find($request->id_delete_condominium_block);
        $collection->delete();

        // notificar
        $data = NotifyHelpers::danger_top_center('far fa-trash-alt', 'Bloco deletado com sucesso.');

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

        $collection = CondominiumBlock::query()
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
                    if (app('router')->has('condominium.block.view') && MenuItem::getMenuItemDeleted('condominium.block.view')['button']) {
                        if (Permission::routePermission('condominium.block.view') && !MenuItem::getMenuItemBlocked('condominium.block.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-condominium-block" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('condominium.block.recover') && MenuItem::getMenuItemDeleted('condominium.block.recover')['button']) {
                        if (Permission::routePermission('condominium.block.recover') && !MenuItem::getMenuItemBlocked('condominium.block.recover')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-condominium-block" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['name', 'description', 'action'])
                ->toJson();
        }

        $dash = PageHelpers::page('92');
        $page = PageHelpers::page('94');
        $list = PageHelpers::page('93');
        $add  = PageHelpers::page('96');

        return view('condominium.blocks.tables.deleted.page', compact('dash', 'page', 'list', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverBlockRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverBlockRequest $request)
    {
        CondominiumBlock::onlyTrashed()->where('entity_id', '=', Entity::id())->find($request->id_recover_condominium_block)->restore();

        // notificar
        $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Bloco recuperado com sucesso.');

        return response()->json($data);
    }
}
