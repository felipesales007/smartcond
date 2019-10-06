<?php

namespace App\Http\Controllers\User;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BlockUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\NewUserRequest;
use App\Http\Requests\User\RecoverUserRequest;
use App\Http\Requests\User\ResendEmailUserRequest;
use App\Http\Requests\User\SendEmailUserRequest;
use App\Models\Company\CompanyAccesses;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use App\Models\User;
use App\Notifications\Auth\VerifyEmail;
use App\Notifications\User\BlockUser;
use App\Notifications\User\DeleteUser;
use App\Notifications\User\EditUser;
use App\Notifications\User\NewUser;
use App\Notifications\User\RecoverUser;
use App\Notifications\User\SendEmailUser;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
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

        $collection = User::query()
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna imagem
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('storage/img/users/photo/' . $row->photo) . '" alt=""></div>';
                    } else {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('img/default/default-user.png') . '" alt=""></div>';
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
                        if (app('router')->has('user.send.email') && Permission::buttonPermission('btn-send-email-user') && !MenuItem::getMenuItemBlocked('user.send.email')['list'] && MenuItem::getMenuItemDeleted('user.send.email')['list'] && $row->id != auth()->id()) {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span data-photo="' . $row->photo . '" data-name="' . $row->name . '" data-email="' . $row->email . '" class="status fe-pointer btn-modal-send-email-user" data-toggle="tooltip" data-placement="top" title="clique aqui para enviar um e-mail para o ' . FormatHelpers::two_word($row->name) . '">' . $row->email . '</span></span>';
                        } else {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span class="status">' . $row->email . '</span></span>';
                        }
                    } else {
                        if (app('router')->has('user.resend.email') && Permission::buttonPermission('btn-resend-email-user') && MenuItem::getMenuItemDeleted('user.resend.email')['list']) {
                            if (!MenuItem::getMenuItemBlocked('user.resend.email')['list']) {
                                $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span><form id="form-resend-email-user" class="d-inline" role="form" autocomplete="off" novalidate><input hidden readonly type="number" id="id-resend-email-user" name="id_resend_email_user" value="' . $row->id . '" minlength="1" maxlength="191" required><button id="btn-resend-email-user" class="btn btn-info btn-xs rounded-circle mt--1"><i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o usuário"></i></button></form>';
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
                    if (app('router')->has('user.view') && MenuItem::getMenuItemDeleted('user.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-user') && !MenuItem::getMenuItemBlocked('user.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-user" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if ($row->id != auth()->id()) {
                        if (app('router')->has('user.edit') && MenuItem::getMenuItemDeleted('user.edit')['list']) {
                            if (Permission::buttonPermission('btn-modal-edit-user') && !MenuItem::getMenuItemBlocked('user.edit')['list'] && $row->id > 3 && auth()->id() > 3 || Permission::buttonPermission('btn-modal-edit-user') && !MenuItem::getMenuItemBlocked('user.edit')['list'] && auth()->id() < 4) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-user" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            }
                        }
                    } else {
                        if (app('router')->has('profile.index') && MenuItem::getMenuItemDeleted('profile.index')) {
                            if (Permission::routePermission('profile.index')) {
                                $btn = $btn . '<a href="' . route('profile.index') . '" class="btn btn-sm btn-icon btn-outline-success" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-user-edit"></i></a>';
                            }
                        }
                    }

                    // bloquear e excluir
                    if ($row->id != auth()->id() && $row->id > 3 && auth()->id() > 3 || $row->id != auth()->id() && auth()->id() < 4) {
                        // bloquear
                        if (app('router')->has('user.ban') && MenuItem::getMenuItemDeleted('user.ban')['list']) {
                            if (Permission::buttonPermission('btn-modal-block-user') && !MenuItem::getMenuItemBlocked('user.ban')['list']) {
                                if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-user" title="Bloquear"><i class="fas fa-ban"></i></a>';
                                } else {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-user" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                        if (app('router')->has('user.delete') && MenuItem::getMenuItemDeleted('user.delete')['list']) {
                            if (Permission::buttonPermission('btn-modal-delete-user') && !MenuItem::getMenuItemBlocked('user.delete')['list']) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-user" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            }
                        }
                    } else {
                        // bloquear
                        if (app('router')->has('user.ban') && MenuItem::getMenuItemDeleted('user.ban')['list']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }

                        // excluir
                        if (app('router')->has('user.delete') && MenuItem::getMenuItemDeleted('user.delete')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'email', 'date', 'action'])
                ->toJson();
        }

        return view('users.list');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewUserRequest $request
     * @return JsonResponse
     */
    public function store(NewUserRequest $request)
    {
        $collection = User::create([
            'name'           => $request->name_new_user,
            'email'          => $request->email_new_user,
            'password'       => Hash::make(Str::random(60)),
            'last_update_at' => now()
        ]);

        Permission::create([
            'user_id'  => $collection->id,
            'route_id' => '1'
        ]);

        $array = $request->all();

        // verifica se há o array de empresa
        if (!in_array('company_id_new_user', $array)) {
            $array = Arr::add($array, 'company_id_new_user', []);
        }

        $array = Arr::sortRecursive($array['company_id_new_user']);

        // adicona a empresa relacionada com o usuário
        for ($i = 0; $i < count($array); $i++) {
            CompanyAccesses::create([
                'company_id' => $array[$i],
                'user_id'    => $collection->id,
                'preferred'  => $i == 0 ? 1 : 0,
            ]);
        }

        // enviar notificação por e-mail
        $token       = app('auth.password.broker')->createToken($collection);
        $this->email = $collection->email;

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new NewUser($token, $collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-user', 'Usuário criado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário criado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
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
        $select = CompanyAccesses::where('user_id', '=', $id)
            ->get()
            ->pluck('company_id')
            ->toArray();

        $array = CompanyAccesses::select('company_accesses.company_id as id','company_accesses.preferred as preferred',
            'companies.name as company', 'companies.cnpj as cnpj', 'companies.logo as logo')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('user_id', '=', $id)
            ->get()
            ->toArray();

        $collection = User::withTrashed()
            ->select('users.*', 'genders.name as gender', 'states.name as state')
            ->leftJoin('genders', 'genders.id', '=', 'gender_id')
            ->leftJoin('states', 'states.id', '=', 'state_id')
            ->where('users.id', '=', $id)
            ->first()
            ->toArray();

        $collection = Arr::add($collection, 'company_id', $select);
        $collection = Arr::add($collection, 'companies', $array);

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditUserRequest $request
     * @return JsonResponse
     */
    public function update(EditUserRequest $request)
    {
        $collection = User::find($request->id_edit_user);
        $original   = $collection->getOriginal();

        // impede a alteração de usuários pré-definidos
        if ($collection->id == auth()->id() || $collection->id < 4 && auth()->id() > 3) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para alterar esse usuário.');

            return response()->json($data);
        }

        // atualização de acesso a empresa
        $array = array_map('intval', $request->all()['company_id_edit_user']);
        $array = Arr::sortRecursive($array);

        $accesses = CompanyAccesses::where('user_id', '=', $request->id_edit_user)
            ->orderBy('company_id', 'asc')
            ->get()
            ->pluck('company_id')
            ->toArray();

        // se houver alteração no acesso de empresa
        if ($array != $accesses) {
            // remove as permissões antigas
            CompanyAccesses::where('user_id', $request->id_edit_user)
                ->whereIn('company_id', $accesses)
                ->delete();

            // adicona as novas permissões
            for ($i = 0; $i < count($array); $i++) {
                CompanyAccesses::create([
                    'company_id' => $array[$i],
                    'user_id'    => $request->id_edit_user,
                    'preferred'  => $i == 0 ? 1 : 0,
                ]);
            }
        }

        // armazena a foto e capa do perfil
        FileHelpers::destination_file($request, $original['photo'], 'image_2', 'photo_edit_user', 'img/users/photo/');
        FileHelpers::destination_file($request, $original['background'], 'image_3', 'background_edit_user', 'img/users/background/');

        // tratamento de data
        if ($request->birthday_edit_user) {
            $request->birthday_edit_user = FormatHelpers::date_br_to_date($request->birthday_edit_user);
        }

        // dados
        $especial = [
            'cpf'          => $request->cpf_edit_user,
            'rg'           => $request->rg_edit_user,
            'birthday'     => $request->birthday_edit_user,
            'contact'      => $request->contact_edit_user,
            'gender_id'    => $request->gender_id_edit_user,
            'description'  => $request->description_edit_user,
            'course'       => $request->course_edit_user,
            'college'      => $request->college_edit_user,
            'profession'   => $request->profession_edit_user,
            'company'      => $request->company_edit_user,
            'postal_code'  => $request->postal_code_edit_user,
            'address'      => $request->address_edit_user,
            'house_number' => $request->house_number_edit_user,
            'complement'   => $request->complement_edit_user,
            'neighborhood' => $request->neighborhood_edit_user,
            'city'         => $request->city_edit_user,
            'state_id'     => $request->state_id_edit_user,
            'country'      => $request->country_edit_user,
            'photo'        => $request->photo_edit_user,
            'background'   => $request->background_edit_user
        ];

        // notificar
        try {
            // enviar notificação por e-mail
            if ($request->password_edit_user) {
                if ($request->email_edit_user != $original['email']) {
                    // edição com senha e com e-mail
                    $collection->fill([
                        'name'              => $request->name_edit_user,
                        'email'             => $request->email_edit_user,
                        'password'          => Hash::make($request->password_edit_user),
                        'email_verified_at' => null
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];
                        $token = app('auth.password.broker')->createToken($collection);

                        // enviar notificação por e-mail
                        $this->notify(new EditUser(null, $collection, $original));
                        $collection->notify(new EditUser($token, $collection, $original));
                        $collection->notify(new VerifyEmail($collection->name));
                    }
                } else {
                    // edição com senha e sem e-mail
                    $collection->fill([
                        'name'     => $request->name_edit_user,
                        'password' => Hash::make($request->password_edit_user)
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];
                        $token = app('auth.password.broker')->createToken($collection);

                        // enviar notificação por e-mail
                        $this->notify(new EditUser($token, $collection, $original));
                    }
                }
            } else {
                if ($request->email_edit_user != $original['email']) {
                    // edição sem senha e com e-mail
                    $collection->fill([
                        'name'              => $request->name_edit_user,
                        'email'             => $request->email_edit_user,
                        'email_verified_at' => null
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];

                        // enviar notificação por e-mail
                        $this->notify(new EditUser(null, $collection, $original));
                        $collection->notify(new EditUser(null, $collection, $original));
                        $collection->notify(new VerifyEmail($collection->name));
                    }
                } else {
                    // edição sem senha e sem e-mail
                    $collection->fill([
                        'name' => $request->name_edit_user
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];

                        // enviar notificação por e-mail
                        $this->notify(new EditUser(null, $collection, $original));
                    }
                }
            }

            $data = NotifyHelpers::success_top_center('fas fa-check', 'Usuário alterado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário alterado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockUserRequest $request
     * @return JsonResponse
     */
    public function block(BlockUserRequest $request)
    {
        $collection = User::find($request->id_block_user);
        $original   = $collection->getOriginal();

        // impede a alteração de usuários pré-definidos
        if ($collection->id == auth()->id() || $collection->id < 4 && auth()->id() > 3) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para bloquear esse usuário.');

            return response()->json($data);
        }

        if ($request->blocked_block_user) {
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
                    $this->notify(new BlockUser($collection->name, $blocked));
                }

                $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Usuário bloqueado com sucesso.');
            } catch (Exception $e) {
                $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário bloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
            }
        } else {
            if ($request->blocked_at_block_user) {
                $date                   = $request->blocked_at_block_user;
                $collection->blocked    = null;
                $collection->blocked_at = FormatHelpers::date_br_to_date($date);

                // notificar
                try {
                    // se alterado salve e envie notificação por e-mail
                    if (FormatHelpers::datetime_to_date($collection->getAttributes()['blocked_at']) != $original['blocked_at']) {
                        $collection->save();
                        $blocked     = ' até ' . $date . ' ';
                        $this->email = $collection->email;
                        $this->notify(new BlockUser($collection->name, $blocked));
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Usuário bloqueado até <b>' . $date . '</b>.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário bloqueado até <b>' . $date . '</b>, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            } else {
                // notificar
                try {
                    if ($original['blocked_at'] >= now()->toDateString() || !$original['blocked_at'] >= now()->toDateString() && !$request->blocked_block_user && !$request->blocked_at_block_user) {
                        $collection->blocked    = null;
                        $collection->blocked_at = null;

                        // se alterado salve e envie notificação por e-mail
                        if ($collection->getAttributes() != $original) {
                            $collection->save();
                            $blocked = null;
                            $this->email = $collection->email;
                            $this->notify(new BlockUser($collection->name, $blocked));
                        }
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Usuário desbloqueado com sucesso.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário desbloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            }
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteUserRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteUserRequest $request)
    {
        $collection  = User::find($request->id_delete_user);
        $this->email = $collection->getOriginal()['email'];

        // impede a alteração de usuários pré-definidos
        if ($collection->id == auth()->id() || $collection->id < 4 && auth()->id() > 3) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para deletar esse usuário.');

            return response()->json($data);
        }

        $collection->delete();

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new DeleteUser($request->name_delete_user));

            $data = NotifyHelpers::danger_top_center('fas fa-trash-alt', 'Usuário deletado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário deletado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Exibir uma listagem do recurso.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function listDeleted(Request $request)
    {
        // filtragem do datatable
        $search = !empty($_GET['search']) ? $_GET['search'] : '';
        $order  = explode(' ', !empty($_GET['orderBy']) ? $_GET['orderBy'] : 'name asc');

        $collection = User::query()
            ->onlyTrashed()
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna imagem
                ->addColumn('photo', function ($row) {
                    if ($row->photo) {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('storage/img/users/photo/' . $row->photo) . '" alt=""></div>';
                    } else {
                        $photo = '<div class="avatar avatar-sm rounded-circle"><img src="' . url('img/default/default-user.png') . '" alt=""></div>';
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
                        $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span class="status">' . $row->email . '</span></span>';
                    } else {
                        $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span>';
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
                    if (app('router')->has('user.view') && MenuItem::getMenuItemDeleted('user.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-user') && !MenuItem::getMenuItemBlocked('user.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-user" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('user.recover') && MenuItem::getMenuItemDeleted('user.recover')['list']) {
                        if (Permission::buttonPermission('btn-modal-recover-user') && !MenuItem::getMenuItemBlocked('user.recover')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-user" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'email', 'date', 'action'])
                ->toJson();
        }

        return view('users.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverUserRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverUserRequest $request)
    {
        $collection  = User::onlyTrashed()->find($request->id_recover_user);
        $this->email = $collection->email;

        $collection->restore();

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new RecoverUser($collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Usuário recuperado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário recuperado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Enviar e-mail para o recurso especificado.
     *
     * @param SendEmailUserRequest $request
     * @return JsonResponse
     */
    public function sendEmail(SendEmailUserRequest $request)
    {
        $collection  = $request->all();
        $this->email = $collection['email_send_email_user'];

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new SendEmailUser($collection));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail enviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Reenviar o e-mail de confirmação para o e-mail especificado ainda não confirmado no armazenamento.
     * @param ResendEmailUserRequest $id
     * @return JsonResponse
     */
    public function resendEmail(ResendEmailUserRequest $id)
    {
        $collection  = User::withTrashed()->find($id->id_resend_email_user);
        $token       = app('auth.password.broker')->createToken($collection);
        $this->email = $collection->email;

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new NewUser($token, $collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail de confirmação reenviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O reenvio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }
}
