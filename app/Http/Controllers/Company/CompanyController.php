<?php

namespace App\Http\Controllers\Company;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Requests\Company\BlockCompanyRequest;
use App\Http\Requests\Company\DeleteCompanyRequest;
use App\Http\Requests\Company\EditCompanyRequest;
use App\Http\Requests\Company\NewCompanyRequest;
use App\Http\Requests\Company\RecoverCompanyRequest;
use App\Http\Requests\Company\SendEmailCompanyRequest;
use App\Models\Company\Company;
use App\Models\Menu\MenuItem;
use App\Models\Permission;
use App\Notifications\Company\BlockCompany;
use App\Notifications\Company\DeleteCompany;
use App\Notifications\Company\NewCompany;
use App\Notifications\Company\EditCompany;
use App\Notifications\Company\RecoverCompany;
use App\Notifications\Company\SendEmailCompany;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\View\View;

class CompanyController extends Controller
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

        $collection = Company::query()
            ->select('companies.*')
            ->orWhere('companies.name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('contact', 'like', '%' . $search . '%')
            ->orWhere('cnpj', 'like', '%' . $search . '%')
            ->orderBy($order[0], $order[1]);

        // listagem
        if ($request->ajax()) {
            // preenchimento das colunas do datatable
            return datatables($collection)
                // coluna logo
                ->addColumn('logo', function ($row) {
                    if ($row->logo) {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('storage/img/companies/logo/' . $row->logo) . '" alt=""></div>';
                    } else {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('img/default/default-logo.png') . '" alt=""></div>';
                    }
                    return $logo;
                })
                // coluna cnpj
                ->addColumn('cnpj', function ($row) {
                    return $row->cnpj;
                })
                // coluna nome
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                // coluna e-mail
                ->addColumn('email', function ($row) {
                    if (app('router')->has('company.send.email') && Permission::buttonPermission('btn-send-email-company') && !MenuItem::getMenuItemBlocked('company.send.email')['list'] && MenuItem::getMenuItemDeleted('company.send.email')['list'] && $row->email != auth()->user()->email) {
                        $email = '<span data-logo="' . $row->logo . '" data-name="' . $row->name . '" data-email="' . $row->email . '" class="status fe-pointer btn-modal-send-email-company" data-toggle="tooltip" data-placement="top" title="clique aqui para enviar um e-mail">' . $row->email . '</span>';
                    } else {
                        $email = $row->email;
                    }
                    return $email;
                })
                // coluna contato
                ->addColumn('contact', function ($row) {
                    return $row->contact;
                })
                // coluna ações
                ->addColumn('action', function ($row) {
                    // visualizar
                    if (app('router')->has('company.view') && MenuItem::getMenuItemDeleted('company.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-company') && !MenuItem::getMenuItemBlocked('company.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-company" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled"><i class="far fa-eye" title="Visualizar"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // editar
                    if (app('router')->has('company.edit') && MenuItem::getMenuItemDeleted('company.edit')['list']) {
                        if (Permission::buttonPermission('btn-modal-edit-company') && !MenuItem::getMenuItemBlocked('company.edit')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-edit-company" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Editar"><i class="fas fa-pencil-alt"></i></a>';
                        }
                    }

                    // bloquear
                    if (app('router')->has('company.ban') && MenuItem::getMenuItemDeleted('company.ban')['list']) {
                        if (Permission::buttonPermission('btn-modal-block-company') && !MenuItem::getMenuItemBlocked('company.ban')['list']) {
                            if ($row->blocked || $row->blocked_at >= now()->toDateString()) {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-warning btn-modal-block-company" title="Bloquear"><i class="fas fa-ban"></i></a>';
                            } else {
                                $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-warning btn-modal-block-company" title="Bloquear"><i class="fas fa-ban"></i></a>';
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
                    if (app('router')->has('company.delete') && MenuItem::getMenuItemDeleted('company.delete')['list']) {
                        if (Permission::buttonPermission('btn-modal-delete-company') && !MenuItem::getMenuItemBlocked('company.delete')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-danger btn-modal-delete-company" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-danger opacity-2 disabled" title="Excluir"><i class="far fa-trash-alt"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['logo', 'name', 'email', 'contact', 'cnpj', 'action'])
                ->toJson();
        }

        return view('companies.list');
    }

    /**
     * Armazenar dados recém-criado no armazenamento.
     *
     * @param NewCompanyRequest $request
     * @return JsonResponse
     */
    public function store(NewCompanyRequest $request)
    {
        // dados
        $collection = Company::create([
            'cnpj'           => $request->cnpj_new_company,
            'name'           => $request->name_new_company,
            'corporate_name' => $request->corporate_name_new_company,
            'email'          => $request->email_new_company,
            'contact'        => $request->contact_new_company,
            'postal_code'    => $request->postal_code_new_company,
            'address'        => $request->address_new_company,
            'house_number'   => $request->house_number_new_company,
            'complement'     => $request->complement_new_company,
            'neighborhood'   => $request->neighborhood_new_company,
            'city'           => $request->city_new_company,
            'state_id'       => $request->state_id_new_company,
            'country'        => $request->country_new_company,
            'last_update_at' => now()
        ]);

        // upload da logo
        if ($request->hasFile('image_4') && $request->file('image_4')->isValid()) {
            $file_name = FormatHelpers::image_name($collection->id);
            FileHelpers::destination_file($request, null, 'image_4', $file_name, 'img/companies/logo/');
            $collection->update(['logo' => $file_name]);
        }

        // notificar
        try {
            // enviar notificação por email
            if ($request->email_new_company) {
                $this->email = $request->email_new_company;
                $this->notify(new NewCompany($collection));
            }

            $data = NotifyHelpers::success_top_center('fas fa-hotel', 'Empresa criada com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa criada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
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
        $collection = Company::withTrashed()
            ->select('companies.*')
            ->where('companies.id', '=', $id)
            ->first();

        return response()->json($collection);
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditCompanyRequest $request
     * @return JsonResponse
     */
    public function update(EditCompanyRequest $request)
    {
        $collection = Company::find($request->id_edit_company);
        $original   = $collection->getOriginal();

        // armazena a logo
        FileHelpers::destination_file($request, $original['logo'], 'image_5', 'logo_edit_company', 'img/companies/logo/');

        // dados
        $collection->fill([
            'cnpj'           => $request->cnpj_edit_company,
            'name'           => $request->name_edit_company,
            'corporate_name' => $request->corporate_name_edit_company,
            'email'          => $request->email_edit_company,
            'contact'        => $request->contact_edit_company,
            'postal_code'    => $request->postal_code_edit_company,
            'address'        => $request->address_edit_company,
            'house_number'   => $request->house_number_edit_company,
            'complement'     => $request->complement_edit_company,
            'neighborhood'   => $request->neighborhood_edit_company,
            'city'           => $request->city_edit_company,
            'state_id'       => $request->state_id_edit_company,
            'country'        => $request->country_edit_company,
            'logo'           => $request->logo_edit_company
        ]);

        // notificar
        try {
            // se houver alterações
            if ($collection->getAttributes() != $original) {
                $collection->fill(['last_update_at' => now()])->save();

                // enviar notificação por email
                if (!$original['email'] && $collection->email) {
                    $this->email = $collection->email;
                    $this->notify(new EditCompany($collection, $original));
                } elseif ($original['email'] && !$collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditCompany($collection, $original));
                } elseif ($original['email'] == $collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditCompany($collection, $original));
                } elseif ($original['email'] != $collection->email) {
                    $this->email = $original['email'];
                    $this->notify(new EditCompany($collection, $original));
                    $this->email = $collection->email;
                    $this->notify(new EditCompany($collection, $original));
                }
            }

            $data = NotifyHelpers::success_top_center('fas fa-check', 'Empresa alterada com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa alterada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Bloquear o recurso especificado no armazenamento.
     *
     * @param BlockCompanyRequest $request
     * @return JsonResponse
     */
    public function block(BlockCompanyRequest $request)
    {
        $collection = Company::find($request->id_block_company);
        $original   = $collection->getOriginal();

        if ($request->blocked_block_company) {
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
                    $this->notify(new BlockCompany($collection->name, $blocked));
                }

                $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Empresa bloqueada com sucesso.');
            } catch (Exception $e) {
                $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa bloqueada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
            }
        } else {
            if ($request->blocked_at_block_company) {
                $date                   = $request->blocked_at_block_company;
                $collection->blocked    = null;
                $collection->blocked_at = FormatHelpers::date_br_to_date($date);

                // notificar
                try {
                    // se alterado salve e envie notificação por e-mail
                    if (FormatHelpers::datetime_to_date($collection->getAttributes()['blocked_at']) != $original['blocked_at']) {
                        $collection->save();
                        $blocked     = ' até ' . $date . ' ';
                        $this->email = $collection->email;
                        $this->notify(new BlockCompany($collection->name, $blocked));
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Empresa bloqueada até <b>' . $date . '</b>.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa bloqueada até <b>' . $date . '</b>, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            } else {
                // notificar
                try {
                    if ($original['blocked_at'] >= now()->toDateString() || !$original['blocked_at'] >= now()->toDateString() && !$request->blocked_block_company && !$request->blocked_at_block_company) {
                        $collection->blocked    = null;
                        $collection->blocked_at = null;

                        // se alterado salve e envie notificação por e-mail
                        if ($collection->getAttributes() != $original) {
                            $collection->save();
                            $blocked = null;
                            $this->email = $collection->email;
                            $this->notify(new BlockCompany($collection->name, $blocked));
                        }
                    }

                    $data = NotifyHelpers::warning_top_center('fas fa-ban', 'Empresa desbloqueada com sucesso.');
                } catch (Exception $e) {
                    $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa desbloqueada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
                }
            }
        }

        return response()->json($data);
    }

    /**
     * Remover o recurso especificado do armazenamento.
     *
     * @param DeleteCompanyRequest $request
     * @return bool|JsonResponse
     */
    public function destroy(DeleteCompanyRequest $request)
    {
        $collection  = Company::find($request->id_delete_company);
        $this->email = $collection->getOriginal()['email'];

        $collection->delete();

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new DeleteCompany($request->name_delete_company));

            $data = NotifyHelpers::danger_top_center('fas fa-trash-alt', 'Empresa deletada com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa deletada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
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

        $collection = Company::query()
            ->onlyTrashed()
            ->select('companies.*')
            ->where(function ($query) use ($search) {
                $query
                    ->orWhere('companies.name', 'like', '%' . $search . '%')
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
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('storage/img/companies/logo/' . $row->logo) . '" alt=""></div>';
                    } else {
                        $logo = '<div class="avatar avatar-sm"><img src="' . url('img/default/default-logo.png') . '" alt=""></div>';
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
                // coluna contato
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
                    if (app('router')->has('company.view') && MenuItem::getMenuItemDeleted('company.view')['list']) {
                        if (Permission::buttonPermission('btn-modal-view-company') && !MenuItem::getMenuItemBlocked('company.view')['list']) {
                            $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-primary btn-modal-view-company" title="Visualizar"><i class="far fa-eye"></i></a>';
                        } else {
                            $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-primary opacity-2 disabled" title="Visualizar"><i class="far fa-eye"></i></a>';
                        }
                    } else {
                        $btn = null;
                    }

                    // recuperar
                    if (app('router')->has('company.recover') && MenuItem::getMenuItemDeleted('company.recover')['list']) {
                        if (Permission::buttonPermission('btn-modal-recover-company') && !MenuItem::getMenuItemBlocked('company.recover')['list']) {
                            $btn = $btn . '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-icon btn-outline-success btn-modal-recover-company" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        } else {
                            $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-outline-success opacity-2 disabled" title="Recuperar"><i class="fas fa-recycle"></i></a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['logo', 'name', 'email', 'contact', 'cnpj', 'action'])
                ->toJson();
        }

        return view('companies.list-deleted');
    }

    /**
     * Restaurar o recurso especificado no armazenamento.
     *
     * @param RecoverCompanyRequest $request
     * @return JsonResponse
     */
    public function restore(RecoverCompanyRequest $request)
    {
        $collection  = Company::onlyTrashed()->find($request->id_recover_company);
        $this->email = $collection->email;

        $collection->restore();

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new RecoverCompany($collection->name));

            $data = NotifyHelpers::success_top_center('fas fa-recycle', 'Empresa recuperada com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Empresa recuperada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Enviar e-mail para o recurso especificado.
     *
     * @param $request
     * @return JsonResponse
     */
    public function sendEmail(SendEmailCompanyRequest $request)
    {
        $collection  = $request->all();
        $this->email = $collection['email_send_email_company'];

        // notificar
        try {
            // enviar notificação por email
            $this->notify(new SendEmailCompany($collection));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail enviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }
}
