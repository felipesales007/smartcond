<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlockAdminRequest;
use App\Http\Requests\Admin\DeleteAdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Http\Requests\Admin\NewAdminRequest;
use App\Http\Requests\Admin\RecoverAdminRequest;
use App\Http\Requests\Admin\ResendEmailAdminRequest;
use App\Http\Requests\Admin\SendEmailAdminRequest;
use App\Models\Company\Company;
use App\Models\Company\CompanyAccesses;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use App\Models\User;
use App\Notifications\Auth\VerifyEmail;
use App\Notifications\Admin\BlockAdmin;
use App\Notifications\Admin\DeleteAdmin;
use App\Notifications\Admin\EditAdmin;
use App\Notifications\Admin\NewAdmin;
use App\Notifications\Admin\RecoverAdmin;
use App\Notifications\Admin\SendEmailAdmin;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
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
            ->select('users.*', 'companies.name as company_name')
            ->join('company_accesses', 'company_accesses.user_id', '=', 'users.id')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('admin', '=', '1')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('users.name', 'like', '%' . $search . '%')
                    ->orWhere('companies.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
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
                // coluna empresa
                ->addColumn('company_name', function ($row) {
                    return $row->company_name;
                })
                // coluna e-mail
                ->addColumn('email', function ($row) {
                    if ($row->email_verified_at) {
                        if (app('router')->has('admin.send.email') && Permission::buttonPermission('btn-send-email-admin') && !MenuItem::getMenuItemBlocked('admin.send.email')['list'] && MenuItem::getMenuItemDeleted('admin.send.email')['list'] && $row->id != auth()->id()) {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span data-photo="' . $row->photo . '" data-name="' . $row->name . '" data-email="' . $row->email . '" class="status fe-pointer btn-modal-send-email-admin" data-toggle="tooltip" data-placement="top" title="clique aqui para enviar um e-mail para ' . FormatHelpers::two_word($row->name) . '">' . $row->email . '</span></span>';
                        } else {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="e-mail confirmado"></i><span class="status">' . $row->email . '</span></span>';
                        }
                    } else {
                        if (app('router')->has('admin.resend.email') && Permission::buttonPermission('btn-resend-email-admin') && MenuItem::getMenuItemDeleted('admin.resend.email')['list']) {
                            if (!MenuItem::getMenuItemBlocked('admin.resend.email')['list'] && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || !MenuItem::getMenuItemBlocked('admin.resend.email')['list'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                                $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span><form class="form-resend-email-admin d-inline" role="form" autocomplete="off" novalidate><input hidden readonly type="number" name="id_resend_email_admin" value="' . $row->id . '" maxlength="191" required><button class="btn btn-info btn-xs btn-resend-email-admin rounded-circle mt--1"><i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o administrador"></i></button></form>';
                            } else {
                                $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span><button class="btn btn-info btn-xs rounded-circle mt-0 opacity-2 disabled"><i class="fas fa-sync-alt"></i></button>';
                            }
                        } else {
                            $email = '<span class="badge badge-dot mr-4"><i class="bg-warning" data-toggle="tooltip" data-placement="top" title="confirmação de e-mail pendente"></i><span class="status">' . $row->email . '</span></span>';
                        }
                    }
                    return $email;
                })
                // coluna data de último login do administrador
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
                    if (app('router')->has('admin.view') && MenuItem::getMenuItemDeleted('admin.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-admin') && !MenuItem::getMenuItemBlocked('admin.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-admin" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if ($row->id != auth()->id()) {
                        if (app('router')->has('admin.edit') && MenuItem::getMenuItemDeleted('admin.edit')['list']) {
                            if (Permission::buttonPermission('btn-modal-edit-admin') && !MenuItem::getMenuItemBlocked('admin.edit')['list'] && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || Permission::buttonPermission('btn-modal-edit-admin') && !MenuItem::getMenuItemBlocked('admin.edit')['list'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-admin" title="Editar"><i class="fas fa-user-edit"></i></a>';
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
                    if ($row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || $row->id != auth()->id() && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                        // bloquear
                        if (app('router')->has('admin.ban') && MenuItem::getMenuItemDeleted('admin.ban')['list']) {
                            if (Permission::buttonPermission('btn-modal-block-admin') && !MenuItem::getMenuItemBlocked('admin.ban')['list']) {
                                if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-admin" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                                } else {
                                    $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-admin" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                        if (app('router')->has('admin.delete') && MenuItem::getMenuItemDeleted('admin.delete')['list']) {
                            if (Permission::buttonPermission('btn-modal-delete-admin') && !MenuItem::getMenuItemBlocked('admin.delete')['list']) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-admin" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                            }
                        }
                    } else {
                        // bloquear
                        if (app('router')->has('admin.ban') && MenuItem::getMenuItemDeleted('admin.ban')['list']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-warning opacity-2 disabled" title="Desbloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-warning opacity-2 disabled" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            }
                        }

                        // excluir
                        if (app('router')->has('admin.delete') && MenuItem::getMenuItemDeleted('admin.delete')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'company_name', 'email', 'date', 'action'])
                ->toJson();
        }

        return view('admins.list');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewAdminRequest $request
     * @return JsonResponse
     */
    public function store(NewAdminRequest $request)
    {
        $collection = User::create([
            'name'           => $request->name_new_admin,
            'email'          => $request->email_new_admin,
            'password'       => Hash::make(Str::random(60)),
            'admin'          => '1',
            'last_update_at' => now()
        ]);

        Permission::create([
            'user_id'  => $collection->id,
            'route_id' => '1'
        ]);

        $accesses = CompanyAccesses::create([
            'company_id' => $request->company_id_new_admin,
            'user_id'    => $collection->id
        ]);

        $company = Company::join('company_accesses', 'company_accesses.company_id', '=', 'companies.id')
            ->where('companies.id', '=', $accesses->company_id)
            ->groupBy('companies.id')
            ->pluck('companies.name')
            ->first();

        // enviar notificação por e-mail
        $token       = app('auth.password.broker')->createToken($collection);
        $this->email = $collection->email;

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new NewAdmin($token, $collection->name, $company));

            $data = NotifyHelpers::success_top_center('fas fa-user-shield', 'Administrador criado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador criado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
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
            ->pluck('company_id')
            ->first();

        $array = CompanyAccesses::select('company_accesses.company_id as id',
            'companies.name as company', 'companies.logo as logo', 'companies.cnpj as cnpj')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('user_id', '=', $id)
            ->first()
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
     * @param EditAdminRequest $request
     * @return JsonResponse
     */
    public function update(EditAdminRequest $request)
    {
        $collection = User::find($request->id_edit_admin);
        $original   = $collection->getOriginal();

        // impede a alteração de administradores de empresas diferente
        if ($collection->id == auth()->id() || CompanyAccesses::getCompanyAccessUser($collection->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para alterar esse administrador.');
            return response()->json($data);
        }

        // se houver mudança atualizar a empresa
        $accesses = CompanyAccesses::where('user_id', '=', $collection->id)->first();
        $originalCompany = $accesses->getOriginal();

        $accesses->fill([
            'company_id' => $request->company_id_edit_admin,
            'user_id'    => $collection->id
        ])->save();

        if ($accesses['company_id'] != $originalCompany['company_id']) {
            $company = Company::join('company_accesses', 'company_accesses.company_id', '=', 'companies.id')
                ->where('companies.id', '=', $accesses->company_id)
                ->groupBy('companies.id')
                ->pluck('companies.name')
                ->first();
        } else {
            $company = null;
        }

        // armazena a foto e capa do perfil
        FileHelpers::destination_file($request, $original['photo'], 'image_photo_edit_admin', 'photo_edit_admin', 'images/users/photo/');
        FileHelpers::destination_file($request, $original['background'], 'image_background_edit_admin', 'background_edit_admin', 'images/users/background/');

        // dados
        $especial = [
            'cpf'          => $request->cpf_edit_admin,
            'rg'           => $request->rg_edit_admin,
            'birthday'     => FormatHelpers::date_br_to_date($request->birthday_edit_admin),
            'contact'      => $request->contact_edit_admin,
            'gender_id'    => $request->gender_id_edit_admin,
            'description'  => $request->description_edit_admin,
            'course'       => $request->course_edit_admin,
            'college'      => $request->college_edit_admin,
            'profession'   => $request->profession_edit_admin,
            'company'      => $request->company_edit_admin,
            'postal_code'  => $request->postal_code_edit_admin,
            'address'      => $request->address_edit_admin,
            'house_number' => $request->house_number_edit_admin,
            'complement'   => $request->complement_edit_admin,
            'neighborhood' => $request->neighborhood_edit_admin,
            'city'         => $request->city_edit_admin,
            'state_id'     => $request->state_id_edit_admin,
            'country'      => $request->country_edit_admin,
            'photo'        => $request->photo_edit_admin,
            'background'   => $request->background_edit_admin
        ];

        // notificar
        try {
            // enviar notificação por e-mail
            if ($request->password_edit_admin) {
                if ($request->email_edit_admin != $original['email']) {
                    // edição com senha e com e-mail
                    $collection->fill([
                        'name'              => $request->name_edit_admin,
                        'email'             => $request->email_edit_admin,
                        'password'          => Hash::make($request->password_edit_admin),
                        'email_verified_at' => null
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original || $company) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];
                        $token = app('auth.password.broker')->createToken($collection);

                        // enviar notificação por e-mail
                        $this->notify(new EditAdmin(null, $collection, $original, $company));
                        $collection->notify(new EditAdmin($token, $collection, $original, $company));
                        $collection->notify(new VerifyEmail($collection->name));
                    }
                } else {
                    // edição com senha e sem e-mail
                    $collection->fill([
                        'name'     => $request->name_edit_admin,
                        'password' => Hash::make($request->password_edit_admin)
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original || $company) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];
                        $token = app('auth.password.broker')->createToken($collection);

                        // enviar notificação por e-mail
                        $this->notify(new EditAdmin($token, $collection, $original, $company));
                    }
                }
            } else {
                if ($request->email_edit_admin != $original['email']) {
                    // edição sem senha e com e-mail
                    $collection->fill([
                        'name'              => $request->name_edit_admin,
                        'email'             => $request->email_edit_admin,
                        'email_verified_at' => null
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original || $company) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];

                        // enviar notificação por e-mail
                        $this->notify(new EditAdmin(null, $collection, $original, $company));
                        $collection->notify(new EditAdmin(null, $collection, $original, $company));
                        $collection->notify(new VerifyEmail($collection->name));
                    }
                } else {
                    // edição sem senha e sem e-mail
                    $collection->fill([
                        'name' => $request->name_edit_admin
                    ]);

                    $collection->fill($especial);

                    // se alterado salve e envie notificação por e-mail
                    if ($collection->getAttributes() != $original || $company) {
                        $collection->fill(['last_update_at' => now()])->save();
                        $this->email = $original['email'];

                        // enviar notificação por e-mail
                        $this->notify(new EditAdmin(null, $collection, $original, $company));
                    }
                }
            }

            $data = NotifyHelpers::success_top_center('fas fa-check', 'Administrador alterado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador alterado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockAdminRequest $request
     * @return JsonResponse
     */
    public function block(BlockAdminRequest $request)
    {
        $collection = User::find($request->id_block_admin);
        $original   = $collection->getOriginal();

        // impede a alteração de administradores de empresas diferente
        if ($collection->id == auth()->id() || CompanyAccesses::getCompanyAccessUser($collection->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para bloquear esse administrador.');
            return response()->json($data);
        }

        if ($request->blocked_block_admin) {
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
                    $this->notify(new BlockAdmin($collection->name, $blocked));
                }

                $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Administrador bloqueado com sucesso.');
            } catch (Exception $e) {
                $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador bloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
            }
        } else {
            if ($request->blocked_at_block_admin) {
                $date                   = $request->blocked_at_block_admin;
                $collection->blocked    = null;
                $collection->blocked_at = FormatHelpers::date_br_to_date($date);

                // notificar
                try {
                    // se alterado salve e envie notificação por e-mail
                    if (FormatHelpers::datetime_to_date($collection->getAttributes()['blocked_at']) != $original['blocked_at']) {
                        $collection->save();
                        $blocked     = ' até ' . $date . ' ';
                        $this->email = $collection->email;
                        $this->notify(new BlockAdmin($collection->name, $blocked));
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Administrador bloqueado até <b>' . $date . '</b>.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador bloqueado até <b>' . $date . '</b>, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            } else {
                // notificar
                try {
                    if ($original['blocked_at'] >= now()->toDateString() || !$original['blocked_at'] >= now()->toDateString() && !$request->blocked_block_admin && !$request->blocked_at_block_admin) {
                        $collection->blocked    = null;
                        $collection->blocked_at = null;

                        // se alterado salve e envie notificação por e-mail
                        if ($collection->getAttributes() != $original) {
                            $collection->save();
                            $blocked = null;
                            $this->email = $collection->email;
                            $this->notify(new BlockAdmin($collection->name, $blocked));
                        }
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Administrador desbloqueado com sucesso.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador desbloqueado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            }
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteAdminRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteAdminRequest $request)
    {
        $collection  = User::find($request->id_delete_admin);
        $this->email = $collection->getOriginal()['email'];

        // impede a alteração de administradores de empresas diferente
        if ($collection->id == auth()->id() || CompanyAccesses::getCompanyAccessUser($collection->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para deletar esse administrador.');
            return response()->json($data);
        }

        $collection->delete();

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new DeleteAdmin($request->name_delete_admin));

            $data = NotifyHelpers::danger_top_center('fas fa-trash-alt', 'Administrador deletado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador deletado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
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
            ->select('users.*', 'companies.name as company_name')
            ->join('company_accesses', 'company_accesses.user_id', '=', 'users.id')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('admin', '=', '1')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('users.name', 'like', '%' . $search . '%')
                    ->orWhere('companies.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            })
            ->orderBy($order[0], $order[1]);

        // listagem de deletados
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
                // coluna empresa
                ->addColumn('company_name', function ($row) {
                    return $row->company_name;
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
                // coluna data de último login do administrador
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
                    if (app('router')->has('admin.view') && MenuItem::getMenuItemDeleted('admin.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-admin') && !MenuItem::getMenuItemBlocked('admin.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-admin" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('admin.recover') && MenuItem::getMenuItemDeleted('admin.recover')['list']) {
                        if (Permission::buttonPermission('btn-modal-recover-admin') && !MenuItem::getMenuItemBlocked('admin.recover')['list'] && CompanyAccesses::getCompanyAccessUser($row->id)['company_id'] == CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] || Permission::buttonPermission('btn-modal-recover-admin') && !MenuItem::getMenuItemBlocked('admin.recover')['list'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] == 1) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-admin" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['photo', 'name', 'company_name', 'email', 'date', 'action'])
                ->toJson();
        }

        return view('admins.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverAdminRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverAdminRequest $request)
    {
        $collection  = User::onlyTrashed()->find($request->id_recover_admin);
        $this->email = $collection->email;

        // impede a alteração de administradores de empresas diferente
        if (CompanyAccesses::getCompanyAccessUser($collection->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] && CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id'] != 1) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para recuperar esse administrador.');
            return response()->json($data);
        }

        $collection->restore();

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new RecoverAdmin($collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Administrador recuperado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Administrador recuperado com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Enviar e-mail para o recurso especificado.
     *
     * @param SendEmailAdminRequest $request
     * @return JsonResponse
     */
    public function sendEmail(SendEmailAdminRequest $request)
    {
        $collection  = $request->all();
        $this->email = $collection['email_send_email_admin'];

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new SendEmailAdmin($collection));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail enviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Reenviar o e-mail de confirmação para o e-mail especificado ainda não confirmado no armazenamento.
     * @param ResendEmailAdminRequest $id
     * @return JsonResponse
     */
    public function resendEmail(ResendEmailAdminRequest $id)
    {
        $collection  = User::withTrashed()->find($id->id_resend_email_admin);

        // impede a alteração de administradores de empresas diferente
        if (CompanyAccesses::getCompanyAccessUser($collection->id)['company_id'] != CompanyAccesses::getCompanyAccessUser(auth()->id())['company_id']) {
            // notificar
            $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Você não tem permissão para realizar o reenvio de e-mail de confirmação para esse administrador.');
            return response()->json($data);
        }

        $company = Company::join('company_accesses', 'company_accesses.company_id', '=', 'companies.id')
            ->where('company_accesses.user_id', '=', $collection->id)
            ->groupBy('companies.id')
            ->pluck('companies.name')
            ->first();

        $token       = app('auth.password.broker')->createToken($collection);
        $this->email = $collection->email;

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new NewAdmin($token, $collection->name, $company));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail de confirmação reenviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O reenvio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }
}
