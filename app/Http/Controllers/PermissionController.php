<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Requests\Permission\EditPermissionRequest;
use App\Models\Company\CompanyAccesses;
use App\Models\Entity\Entity;
use App\Models\Entity\EntityAccesses;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use App\Models\Route\Group;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class PermissionController extends Controller
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
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'created_at desc');

        $collection = User::query()
            ->select('users.id', 'photo', 'name', 'users.created_at')
            ->selectRaw('count(permissions.user_id) as permission')
            ->leftJoin('permissions', 'permissions.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->having('permission', '<=', '1')
            ->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            })
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query
                    ->leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
                    ->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna imagem
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('storage/images/users/photo/' . $row->photo) . '" alt=""></div>';
                    } else {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('images/default/default-user.png') . '" alt=""></div>';
                    }
                    return $photo;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna data de criação do usuário
                ->addColumn('date', function ($row) {
                    return 'há ' . FormatHelpers::remove_last_word(' depois', now()->diffForHumans($row->created_at));
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // editar
                    if ($row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || $row->id != auth()->id() && EntityAccesses::getEntityAccessesUser($row->id)['entity_id'] || $row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                        if (app('router')->has('permission.user.edit') && MenuItem::getMenuItemDeleted('permission.user.edit')['list']) {
                            if (Permission::buttonPermission('btn-edit-permission-user') && !MenuItem::getMenuItemBlocked('permission.user.edit')['list']) {
                                $btn = '<a href="' . route('permission.user.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-icon btn-outline-success"><i class="fas fa-lock-open mr-2"></i>liberar acesso</a>';
                            } else {
                                $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled"><i class="fas fa-lock-open mr-2"></i>liberar acesso</a>';
                            }
                        } else {
                            $btn = null;
                        }
                    } else {
                        $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled"><i class="fas fa-lock mr-2"></i>liberar acesso</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'date', 'action'])
                ->toJson();
        }

        return view('permissions.list');
    }

    /**
     * Exibir uma listagem do recurso.
     *
     * @param Request $request
     * @return Factory|JsonResponse|View|mixed
     * @throws Exception
     */
    public function listAll(Request $request)
    {
        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = User::query()
            ->select('users.id', 'photo', 'name', 'users.created_at')
            ->selectRaw('count(permissions.user_id) as permission')
            ->leftJoin('permissions', 'permissions.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->having('permission', '>', '1')
            ->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            })
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query
                    ->leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
                    ->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna imagem
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('storage/images/users/photo/' . $row->photo) . '" alt=""></div>';
                    } else {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('images/default/default-user.png') . '" alt=""></div>';
                    }
                    return $photo;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna data de criação do usuário
                ->addColumn('date', function ($row) {
                    return 'há ' . FormatHelpers::remove_last_word(' depois', now()->diffForHumans($row->created_at));
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // editar
                    if ($row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || $row->id != auth()->id() && EntityAccesses::getEntityAccessesUser($row->id)['entity_id'] || $row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                        if (app('router')->has('permission.user.edit') && MenuItem::getMenuItemDeleted('permission.user.edit')['list']) {
                            if (Permission::buttonPermission('btn-edit-permission-user') && !MenuItem::getMenuItemBlocked('permission.user.edit')['list']) {
                                $btn = '<a href="' . route('permission.user.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-icon btn-outline-success"><i class="fas fa-lock-open mr-2"></i>liberar acesso</a>';
                            } else {
                                $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled"><i class="fas fa-lock-open mr-2"></i>liberar acesso</a>';
                            }
                        } else {
                            $btn = null;
                        }
                    } else {
                        $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled"><i class="fas fa-lock mr-2"></i>liberar acesso</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'date', 'action'])
                ->toJson();
        }

        return view('permissions.list-all');
    }

    /**
     * Mostrar o formulário para editar o recurso especificado.
     *
     * @param Request $id
     * @return Factory|View
     */
    public function edit(Request $id)
    {
        $user = User::where('users.id', '=', $id->get('id'))->first();

        // impede a alteração de usuários pré-definidos
        if ($user->id == auth()->id() || CompanyAccesses::getCompanyAccessUser($user->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && !EntityAccesses::getEntityAccessesUser($user->id)['entity_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para editar as permissões desse usuário.');
            return back()->with('notify', json_encode($data));
        }

        $groups = Group::select('groups.id as group', 'groups.name', 'icon')
            ->join('routes', 'routes.group_id', '=', 'groups.id')
            ->join('permissions', 'permissions.route_id', '=', 'routes.id')
            ->join('menu_items', 'menu_items.route_id', '=', 'routes.id')
            ->join('menu', 'menu.id', '=', 'menu_items.menu_id')
            ->groupBy('groups.name')
            ->orderBy('groups.name', 'asc')
            ->where('permissions.user_id', '=', auth()->id())
            ->get()
            ->toArray();

        $permissions = Permission::select('groups.id as group', 'routes.id', 'routes.view', 'routes.url',
            'menu_items.name as name', 'menu_items.button as button', 'menu_items.list as list', 'routes.description')
            ->join('routes', 'routes.id', '=', 'permissions.route_id')
            ->join('groups', 'groups.id', '=', 'routes.group_id')
            ->leftJoin('menu_items', 'menu_items.route_id', 'routes.id')
            ->where('user_id', '=', auth()->id())
            ->groupBy('routes.id')
            ->orderBy('routes.view', 'desc')
            ->orderBy('menu_items.list', 'asc')
            ->orderBy('menu_items.button', 'asc')
            ->orderBy('routes.url', 'asc')
            ->orderBy('menu_items.name', 'asc')
            ->get()
            ->toArray();

        $accesses = Permission::select('routes.id')
            ->join('routes', 'routes.id', '=', 'permissions.route_id')
            ->where('user_id', '=', $user['id'])
            ->pluck('routes.id')
            ->all();

        return view('permissions.edit', compact('user', 'groups', 'permissions', 'accesses'));
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditPermissionRequest $request
     * @return RedirectResponse
     */
    public function update(EditPermissionRequest $request)
    {
        $collection = $request->all();
        $id = $request->id_edit_user_permission;

        // impede a alteração de usuários pré-definidos
        if ($id == auth()->id() || CompanyAccesses::getCompanyAccessUser($id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && !EntityAccesses::getEntityAccessesUser($id)['entity_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para alterar as permissões desse usuário.');
            return back()->with('notify', json_encode($data));
        }

        // verifica se há o array de permissão para o sistema
        if (!in_array('permission_edit_user', $collection)) {
            $collection = Arr::add($collection, 'permission_edit_user', []);
        }

        $collection = $collection['permission_edit_user'];

        // verifica se há a permissão mínima para o sistema
        if (!in_array(1, $collection)) {
            $collection = Arr::prepend($collection, '1');
        }

        $collection = Arr::sortRecursive($collection);
        $permissons = Permission::select('route_id')
            ->selectRaw('count(route_id) as equal')
            ->whereIn('user_id', [$request->id_edit_user_permission, auth()->id()])
            ->groupBy('route_id')
            ->having('equal', '>', '1')
            ->orderBy('route_id', 'asc')
            ->get()
            ->pluck('route_id')
            ->toArray();

        // se houver alterações nas permissões
        if ($collection != $permissons) {
            // remove as permissões antigas
            Permission::where('user_id', $request->id_edit_user_permission)
                ->whereIn('route_id', $permissons)
                ->delete();

            // adicona as novas permissões
            for ($i = 0; $i < count($collection); $i++) {
                Permission::create([
                    'user_id'  => $request->id_edit_user_permission,
                    'route_id' => $collection[$i]
                ]);
            }
        }

        $data = NotifyHelpers::success_top_center('fas fa-check', 'Permissões do usuário alterada com sucesso.');

        return back()->with('notify', json_encode($data));
    }
}
