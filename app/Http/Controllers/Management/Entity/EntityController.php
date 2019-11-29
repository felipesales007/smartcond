<?php

namespace App\Http\Controllers\Management\Entity;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Helpers\PageHelpers;
use App\Http\Requests\Management\Entity\BlockEntityRequest;
use App\Http\Requests\Management\Entity\DeleteEntityRequest;
use App\Http\Requests\Management\Entity\EditEntityRequest;
use App\Http\Requests\Management\Entity\NewEntityRequest;
use App\Http\Requests\Management\Entity\NewUserEntityRequest;
use App\Http\Requests\Management\Entity\RecoverEntityRequest;
use App\Http\Requests\Management\Entity\SendEmailEntityRequest;
use App\Models\Company\Company;
use App\Models\Entity\Entity;
use App\Models\Entity\EntityAccess;
use App\Models\Menu\MenuItem;
use App\Models\User\Permission;
use App\Models\User\User;
use App\Notifications\Entity\BlockEntity;
use App\Notifications\Entity\DeleteEntity;
use App\Notifications\Entity\NewEntity;
use App\Notifications\Entity\EditEntity;
use App\Notifications\Entity\RecoverEntity;
use App\Notifications\Entity\SendEmailEntity;
use App\Notifications\User\NewUser;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EntityController extends Controller
{
    use Notifiable;

    /**
     * E-mail para notificar.
     *
     * @var string
     */
    private $email;

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

        $collection = Entity::query()
            ->select('entities.*')
            ->leftJoin('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('entities.name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('contact', 'like', '%' . $search . '%')
                    ->orWhere('cnpj', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna logo
                ->addColumn('logo', function ($row) {
                    if ($row->logo) {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('storage/images/companies/logo/' . $row->logo) . '" alt=""></div>';
                    } else {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('images/default/default-logo.png') . '" alt=""></div>';
                    }
                    return $logo;
                })
                // coluna cnpj
                ->addColumn('cnpj', function ($row) {
                    return $row->cnpj;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    if (app('router')->has('entity.user.store') && Permission::routePermission('entity.user.store') && !MenuItem::getMenuItemBlocked('entity.user.store')['button'] && MenuItem::getMenuItemDeleted('entity.user.store')['button'] && auth()->user()['admin'] == 1) {
                        $name = '<span data-id="' . $row->id . '" data-logo="' . $row->logo . '" data-name="' . $row->name . '" class="status fe-pointer btn-modal-new-user-entity" data-toggle="tooltip" data-placement="top" title="clique aqui para criar um novo usuário neste condomínio">' . $row->name . '</span>';
                    } else {
                        $name = $row->name;
                    }
                    return $name;
                })
                // coluna e-mail
                ->addColumn('email', function ($row) {
                    if (app('router')->has('entity.send.email') && Permission::routePermission('entity.send.email') && !MenuItem::getMenuItemBlocked('entity.send.email')['button'] && MenuItem::getMenuItemDeleted('entity.send.email')['button'] && $row->email != auth()->user()->email) {
                        $email = '<span data-logo="' . $row->logo . '" data-name="' . $row->name . '" data-email="' . $row->email . '" class="status fe-pointer btn-modal-send-email-entity" data-toggle="tooltip" data-placement="top" title="clique aqui para enviar um e-mail">' . $row->email . '</span>';
                    } else {
                        $email = $row->email;
                    }
                    return $email;
                })
                // coluna telefone
                ->addColumn('contact', function ($row) {
                    return $row->contact;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('entity.view') && MenuItem::getMenuItemDeleted('entity.view')['button']) {
                        if (Permission::routePermission('entity.view') && !MenuItem::getMenuItemBlocked('entity.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-entity" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('entity.edit') && MenuItem::getMenuItemDeleted('entity.edit')['button']) {
                        if (Permission::routePermission('entity.edit') && !MenuItem::getMenuItemBlocked('entity.edit')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-entity" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('entity.ban') && MenuItem::getMenuItemDeleted('entity.ban')['button']) {
                        if (Permission::routePermission('entity.ban') && !MenuItem::getMenuItemBlocked('entity.ban')['button'] && auth()->user()['admin'] == 1) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-entity" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-entity" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        } else {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }
                    }

                    // excluir
                    if (app('router')->has('entity.delete') && MenuItem::getMenuItemDeleted('entity.delete')['button']) {
                        if (Permission::routePermission('entity.delete') && !MenuItem::getMenuItemBlocked('entity.delete')['button'] && auth()->user()['admin'] == 1) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-entity" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['logo', 'name', 'email', 'contact', 'cnpj', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('entity.list');
        $list = PageHelpers::page('entity.list.deleted');
        $dash = PageHelpers::page('entity.dashboard');
        $add  = PageHelpers::page('entity.store');

        return view('management.entities.tables.all.page', compact('page', 'list', 'dash', 'add'));
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewEntityRequest $request
     * @return JsonResponse
     */
    public function store(NewEntityRequest $request)
    {
        // impede a criação não autorizado
        if (auth()->user()['admin'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para criar.');
            return response()->json($data);
        }

        // dados
        $collection = Entity::create([
            'cnpj'           => $request->cnpj_new_entity,
            'name'           => $request->name_new_entity,
            'corporate_name' => $request->corporate_name_new_entity,
            'email'          => $request->email_new_entity,
            'contact'        => $request->contact_new_entity,
            'postal_code'    => $request->postal_code_new_entity,
            'address'        => $request->address_new_entity,
            'house_number'   => $request->house_number_new_entity,
            'complement'     => $request->complement_new_entity,
            'neighborhood'   => $request->neighborhood_new_entity,
            'city'           => $request->city_new_entity,
            'state_id'       => $request->state_id_new_entity,
            'country'        => $request->country_new_entity,
            'last_update_at' => now()
        ]);

        // upload da logo
        if ($request->hasFile('image_logo_new_entity') && $request->file('image_logo_new_entity')->isValid()) {
            $file_name = FormatHelpers::image_name($collection->id);
            FileHelpers::destination_file($request, null, 'image_logo_new_entity', $file_name, 'images/companies/logo/');
            $collection->update(['logo' => $file_name]);
        }

        // notificar
        try {
            // enviar notificação por email
            if ($request->email_new_entity) {
                $this->email = $request->email_new_entity;
                $this->notify(new NewEntity($collection));
            }

            $data = NotifyHelpers::success_top_center('fas fa-hotel', 'Condomínio criado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio criado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

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
        $collection = Entity::withTrashed()->find($id);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditEntityRequest $request
     * @return JsonResponse
     */
    public function update(EditEntityRequest $request)
    {
        $collection = Entity::find($request->id_edit_entity);
        $original   = $collection->getOriginal();

        // armazena a logo
        FileHelpers::destination_file($request, $original['logo'], 'image_logo_edit_entity', 'logo_edit_entity', 'images/companies/logo/');

        // dados
        $collection->fill([
            'cnpj'           => $request->cnpj_edit_entity,
            'name'           => $request->name_edit_entity,
            'corporate_name' => $request->corporate_name_edit_entity,
            'email'          => $request->email_edit_entity,
            'contact'        => $request->contact_edit_entity,
            'postal_code'    => $request->postal_code_edit_entity,
            'address'        => $request->address_edit_entity,
            'house_number'   => $request->house_number_edit_entity,
            'complement'     => $request->complement_edit_entity,
            'neighborhood'   => $request->neighborhood_edit_entity,
            'city'           => $request->city_edit_entity,
            'state_id'       => $request->state_id_edit_entity,
            'country'        => $request->country_edit_entity,
            'logo'           => $request->logo_edit_entity
        ]);

        // notificar
        try {
            // se houver alterações
            if ($collection->getAttributes() != $original) {
                $collection->fill(['last_update_at' => now()])->save();

                // enviar notificação por email
                if (!$original['email'] && $collection->email) {
                    $this->email = $collection->email;
                    $this->notify(new EditEntity($collection, $original));
                } elseif ($original['email'] && !$collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditEntity($collection, $original));
                } elseif ($original['email'] == $collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditEntity($collection, $original));
                } elseif ($original['email'] != $collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditEntity($collection, $original));
                    $this->email = $collection->email;
                    $this->notify(new EditEntity($collection, $original));
                }
            }

            $data = NotifyHelpers::success_top_center('fas fa-check', 'Condomínio alterado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio alterado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockEntityRequest $request
     * @return JsonResponse
     */
    public function block(BlockEntityRequest $request)
    {
        // impede o bloqueio não autorizado
        if (auth()->user()['admin'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para bloquear.');
            return response()->json($data);
        }

        $collection = Entity::find($request->id_block_entity);
        $original   = $collection->getOriginal();

        if ($request->blocked_block_entity) {
            // notificar
            try {
                // se alterado salve e envie notificação por e-mail
                if (!$collection->blocked) {
                    $collection->blocked    = now()->toDateTimeString();
                    $collection->blocked_at = null;
                    $collection->save();

                    // enviar notificação por e-mail
                    $blocked     = ' ';
                    $this->email = $collection->email;
                    $this->notify(new BlockEntity($collection->name, $blocked));
                }

                $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Condomínio bloqueado com sucesso.');
            } catch (Exception $e) {
                $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio bloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
            }
        } else {
            if ($request->blocked_at_block_entity) {
                $date                   = $request->blocked_at_block_entity;
                $collection->blocked    = null;
                $collection->blocked_at = FormatHelpers::date_br_to_date($date);

                // notificar
                try {
                    // se alterado salve e envie notificação por e-mail
                    if (FormatHelpers::datetime_to_date($collection->getAttributes()['blocked_at']) != $original['blocked_at']) {
                        $collection->save();
                        $blocked     = ' até ' . $date . ' ';
                        $this->email = $collection->email;
                        $this->notify(new BlockEntity($collection->name, $blocked));
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Condomínio bloqueado até <b>' . $date . '</b>.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio bloqueado até <b>' . $date . '</b>, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            } else {
                // notificar
                try {
                    if ($original['blocked_at'] >= now()->toDateString() || !$original['blocked_at'] >= now()->toDateString() && !$request->blocked_block_entity && !$request->blocked_at_block_entity) {
                        $collection->blocked    = null;
                        $collection->blocked_at = null;

                        // se alterado salve e envie notificação por e-mail
                        if ($collection->getAttributes() != $original) {
                            $collection->save();
                            $blocked = null;
                            $this->email = $collection->email;
                            $this->notify(new BlockEntity($collection->name, $blocked));
                        }
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Condomínio desbloqueado com sucesso.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio desbloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            }
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteEntityRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteEntityRequest $request)
    {
        // impede a exclusão não autorizado
        if (auth()->user()['admin'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para excluir.');
            return response()->json($data);
        }

        $collection  = Entity::find($request->id_delete_entity);
        $this->email = $collection->getOriginal()['email'];

        $collection->delete();

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new DeleteEntity($request->name_delete_entity));

            $data = NotifyHelpers::danger_top_center('fas fa-trash-alt', 'Condomínio deletado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio deletado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

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

        $collection = Entity::query()
            ->onlyTrashed()
            ->select('entities.*')
            ->join('entity_accesses', 'entity_accesses.id', 'entities.id')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('entities.name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('contact', 'like', '%' . $search . '%')
                    ->orWhere('cnpj', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna logo
                ->addColumn('logo', function ($row) {
                    if ($row->logo) {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('storage/images/companies/logo/' . $row->logo) . '" alt=""></div>';
                    } else {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('images/default/default-logo.png') . '" alt=""></div>';
                    }
                    return $logo;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna e-mail
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                // coluna telefone
                ->addColumn('contact', function ($row) {
                    return $row->contact;
                })
                // coluna cnpj
                ->addColumn('cnpj', function ($row) {
                    return $row->cnpj;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('entity.view') && MenuItem::getMenuItemDeleted('entity.view')['button']) {
                        if (Permission::routePermission('entity.view') && !MenuItem::getMenuItemBlocked('entity.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-entity" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('entity.recover') && MenuItem::getMenuItemDeleted('entity.recover')['button']) {
                        if (Permission::routePermission('entity.recover') && !MenuItem::getMenuItemBlocked('entity.recover')['button'] && auth()->user()['admin'] == 1) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-entity" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['logo', 'name', 'email', 'contact', 'cnpj', 'action'])
                ->toJson();
        }

        $page = PageHelpers::page('entity.list.deleted');
        $list = PageHelpers::page('entity.list');
        $dash = PageHelpers::page('entity.dashboard');
        $add  = PageHelpers::page('entity.store');

        return view('management.entities.tables.deleted.page', compact('page', 'list', 'dash', 'add'));
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverEntityRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverEntityRequest $request)
    {
        // impede a recuperação não autorizado
        if (auth()->user()['admin'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para recuperar.');
            return response()->json($data);
        }

        $collection  = Entity::onlyTrashed()->find($request->id_recover_entity);
        $this->email = $collection->email;

        $collection->restore();

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new RecoverEntity($collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Condomínio recuperado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Condomínio recuperado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Enviar e-mail para o recurso especificado.
     *
     * @param $request
     * @return JsonResponse
     */
    public function sendEmail(SendEmailEntityRequest $request)
    {
        $collection  = $request->all();
        $this->email = $collection['email_send_email_entity'];

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new SendEmailEntity($collection));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail enviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewUserEntityRequest $request
     * @return JsonResponse
     */
    public function storeUser(NewUserEntityRequest $request)
    {
        $collection = User::create([
            'name'           => $request->name_new_user_entity,
            'email'          => $request->email_new_user_entity,
            'password'       => Hash::make(Str::random(60)),
            'last_update_at' => now()
        ]);

        Permission::create([
            'user_id'  => $collection->id,
            'route_id' => '1'
        ]);

        $accesses = EntityAccess::create([
            'entity_id' => $request->id_entity_new_user_entity,
            'user_id'   => $collection->id,
            'preferred' => '1'
        ]);

        $entity = Entity::join('entity_accesses', 'entity_accesses.entity_id', '=', 'entities.id')
            ->where('entities.id', '=', $accesses->entity_id)
            ->groupBy('entities.id')
            ->pluck('entities.name')
            ->first();

        // enviar notificação por e-mail
        $token       = app('auth.password.broker')->createToken($collection);
        $this->email = $collection->email;

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new NewUser($token, $collection->name, $entity));

            $data = NotifyHelpers::success_top_center('fas fa-user', 'Usuário criado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário criado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Exibir uma listagem do recurso.
     *
     * @param Request $request
     * @return Factory|JsonResponse|View|mixed
     */
    public function listUsers(Request $request)
    {
        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');
        $id     = !empty($_GET['entity']) ? $_GET['entity'] : '';

        $entity = Entity::find($request->get('id'));

        $collection = User::query()
            ->select('users.*', 'entities.id as entity_id', 'entities.name as entity_name')
            ->join('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
            ->join('entities', 'entities.id', '=', 'entity_accesses.entity_id')
            ->where('admin', '=', '0')
            ->where('entities.id', '=', $id)
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            })
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->groupBy('users.id')
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
                // coluna e-mail
                ->addColumn('email', function ($row) {
                    if ($row->email_verified_at) {
                        if (app('router')->has('user.send.email') && Permission::routePermission('user.send.email') && !MenuItem::getMenuItemBlocked('user.send.email')['button'] && MenuItem::getMenuItemDeleted('user.send.email')['button'] && $row->id != auth()->id() && in_array($row->entity_id, Entity::getEntitiesUser()->toArray()) || app('router')->has('user.send.email') && Permission::routePermission('user.send.email') && !MenuItem::getMenuItemBlocked('user.send.email')['button'] && MenuItem::getMenuItemDeleted('user.send.email')['button'] && $row->id != auth()->id() && auth()->user()['admin'] == 1) {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span data-photo="' . $row->photo . '" data-name="' . $row->name . '" data-email="' . $row->email . '" class="status fe-pointer btn-modal-send-email-user" data-toggle="tooltip" data-placement="top" title="clique aqui para enviar um e-mail para ' . FormatHelpers::two_word($row->name) . '">' . $row->email . '</span></span>';
                        } else {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span class="status">' . $row->email . '</span></span>';
                        }
                    } else {
                        if (app('router')->has('user.resend.email') && Permission::routePermission('user.resend.email') && MenuItem::getMenuItemDeleted('user.resend.email')['button']) {
                            if (!MenuItem::getMenuItemBlocked('user.resend.email')['button'] && in_array($row->entity_id, Entity::getEntitiesUser()->toArray()) || !MenuItem::getMenuItemBlocked('user.resend.email')['button'] && auth()->user()['admin'] == 1) {
                                $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span><form class="form-resend-email-user d-inline" role="form" autocomplete="off" novalidate><input hidden readonly type="number" name="id_resend_email_user" value="' . $row->id . '" maxlength="191" required><button class="btn btn-info btn-xs rounded-circle btn-resend-email-user mt--1"><i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o usuário"></i></button></form>';
                            } else {
                                $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span><button class="btn btn-info btn-xs rounded-circle mt-0 opacity-2 disabled"><i class="fas fa-sync-alt"></i></button>';
                            }
                        } else {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span>';
                        }
                    }
                    return $email;
                })
                // coluna data de último login do usuário
                ->addColumn('date', function ($row) {
                    if ($row->last_login_at) {
                        $date = 'há ' . FormatHelpers::remove_last_word(' depois', now()->diffForHumans($row->last_login_at));
                    } else {
                        $date = 'nunca logou';
                    }
                    return $date;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('user.view') && MenuItem::getMenuItemDeleted('user.view')['button']) {
                        if (Permission::routePermission('user.view') && !MenuItem::getMenuItemBlocked('user.view')['button']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-user" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if ($row->id != auth()->id()) {
                        if (app('router')->has('user.edit') && MenuItem::getMenuItemDeleted('user.edit')['button']) {
                            if (Permission::routePermission('user.edit') && !MenuItem::getMenuItemBlocked('user.edit')['button'] && in_array($row->entity_id, Entity::getEntitiesUser()->toArray()) || Permission::routePermission('user.edit') && !MenuItem::getMenuItemBlocked('user.edit')['button'] && auth()->user()['admin'] == 1) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-user" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            }
                        }
                    } else {
                        if (app('router')->has('profile.edit') && MenuItem::getMenuItemDeleted('profile.edit')) {
                            if (Permission::routePermission('profile.edit')) {
                                $btn = $btn . '<a href="' . route('profile.edit') . '" class="btn btn-sm btn-icon btn-outline-success" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            }
                        }
                    }

                    // bloquear e excluir
                    if ($row->id != auth()->id()) {
                        // bloquear
                        if (app('router')->has('user.ban') && MenuItem::getMenuItemDeleted('user.ban')['button']) {
                            if (Permission::routePermission('user.ban') && !MenuItem::getMenuItemBlocked('user.ban')['button'] && in_array($row->entity_id, Entity::getEntitiesUser()->toArray()) || Permission::routePermission('user.ban') && !MenuItem::getMenuItemBlocked('user.ban')['button'] && auth()->user()['admin'] == 1) {
                                if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-user" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                                } else {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-user" title="Bloquear"><i class="fas fa-ban"></i></a>';
                                }
                            } else {
                                if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                    $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                                } else {
                                    $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                                }
                            }
                        }

                        // excluir
                        if (app('router')->has('user.delete') && MenuItem::getMenuItemDeleted('user.delete')['button']) {
                            if (Permission::routePermission('user.delete') && !MenuItem::getMenuItemBlocked('user.delete')['button'] && in_array($row->entity_id, Entity::getEntitiesUser()->toArray()) || Permission::routePermission('user.delete') && !MenuItem::getMenuItemBlocked('user.delete')['button'] && auth()->user()['admin'] == 1) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-user" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            }
                        }
                    } else {
                        // bloquear
                        if (app('router')->has('user.ban') && MenuItem::getMenuItemDeleted('user.ban')['button']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }

                        // excluir
                        if (app('router')->has('user.delete') && MenuItem::getMenuItemDeleted('user.delete')['button']) {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'email', 'date', 'action'])
                ->toJson();
        }

        // impede o acesso não autorizado
        if (!Company::id() && !in_array($request->get('id'), Entity::getEntitiesUser()->toArray())) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para acessar essa página.');
            return back()->with('notify', json_encode($data));
        }

        $page = PageHelpers::page('entity.list.users');
        $add  = PageHelpers::page('entity.user.store');

        return view('management.entities.tables.users.page', compact('page', 'add', 'entity'));
    }
}
