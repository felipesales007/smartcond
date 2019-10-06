<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\FileHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\NotifyHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\EditProfileRequest;
use App\Http\Requests\Profile\PasswordResetRequest;
use App\Http\Requests\Profile\SendSupportRequest;
use App\Models\Company\CompanyAccesses;
use App\Models\User;
use App\Notifications\Auth\VerifyEmail;
use App\Notifications\Profile\SendSupport;
use App\Notifications\User\EditUser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use Notifiable;

    /**
     * E-mail para notificar.
     *
     * @var string
     */
    private $email;

    /**
     * Mostrar a página solicitada.
     *
     * @return Factory|View
     */
    public function index()
    {
        $array = CompanyAccesses::select('company_accesses.company_id as id','company_accesses.preferred as preferred',
            'companies.name as company', 'companies.cnpj as cnpj', 'companies.logo as logo')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('user_id', '=', auth()->id())
            ->get();

        return view('profile.profile', compact('array'));
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param EditProfileRequest $request
     * @return RedirectResponse
     */
    public function update(EditProfileRequest $request)
    {
        $collection = User::find($request->id_edit_profile);
        $original   = $collection->getOriginal();
        $preferred  = CompanyAccesses::where('user_id', '=', $request->id_edit_profile)
            ->where('company_id', '=', $request->company_edit_profile_id)
            ->first();

        // se houver mudança na empresa principal atualiza a empresa princiapl
        if ($preferred['preferred'] == 0) {
            $accesses = CompanyAccesses::where('user_id', '=', $request->id_edit_profile)
                ->orderBy('company_id', 'asc')
                ->get()
                ->toArray();

            for ($i = 0; $i < count($accesses); $i++) {
                CompanyAccesses::find($accesses[$i]['id'])->update([
                    'preferred' => $accesses[$i]['company_id'] == $preferred['company_id'] ? 1 : 0
                ]);
            }
        }

        // armazena a foto e capa do perfil
        FileHelpers::destination_file($request, $original['photo'], 'image_0', 'photo_edit_profile', 'img/users/photo/');
        FileHelpers::destination_file($request, $original['background'], 'image_1', 'background_edit_profile', 'img/users/background/');

        // tratamento de data
        if ($request->birthday_edit_profile) {
            $request->birthday_edit_profile = FormatHelpers::date_br_to_date($request->birthday_edit_profile);
        }

        // dados
        $collection->fill([
            'name'         => $request->name_edit_profile,
            'cpf'          => $request->cpf_edit_profile,
            'rg'           => $request->rg_edit_profile,
            'email'        => $request->email_edit_profile,
            'birthday'     => $request->birthday_edit_profile,
            'contact'      => $request->contact_edit_profile,
            'gender_id'    => $request->gender_id_edit_profile,
            'description'  => $request->description_edit_profile,
            'course'       => $request->course_edit_profile,
            'college'      => $request->college_edit_profile,
            'profession'   => $request->profession_edit_profile,
            'company'      => $request->company_edit_profile,
            'postal_code'  => $request->postal_code_edit_profile,
            'address'      => $request->address_edit_profile,
            'house_number' => $request->house_number_edit_profile,
            'complement'   => $request->complement_edit_profile,
            'neighborhood' => $request->neighborhood_edit_profile,
            'city'         => $request->city_edit_profile,
            'state_id'     => $request->state_id_edit_profile,
            'country'      => $request->country_edit_profile,
            'photo'        => $request->photo_edit_profile,
            'background'   => $request->background_edit_profile
        ]);

        // notificar
        try {
            // enviar notificação por email
            if ($collection->getAttributes() != $original) {
                $collection->fill(['last_update_at' => now()])->save();
                $this->email = $original['email'];

                // enviar notificação por e-mail
                if ($request->email_edit_profile != $original['email']) {
                    $this->notify(new EditUser(null, $collection, $original));
                    $collection->notify(new EditUser(null, $collection, $original));
                    $collection->notify(new VerifyEmail($collection->name));
                } else {
                    $this->notify(new EditUser(null, $collection, $original));
                }
            }

            $data = NotifyHelpers::success_top_center('fas fa-check', 'Usuário atualizado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Usuário atualizado com sucesso, porém o envio de e-mail falhou.');
        }

        return back()->with('notify', json_encode($data));
    }

    /**
     * Atualizar dados especificado no armazenamento.
     *
     * @param PasswordResetRequest $request
     * @return JsonResponse
     */
    public function passwordReset(PasswordResetRequest $request)
    {
        $collection = User::find(auth()->user()['id']);
        $original   = $collection->getOriginal();

        $collection->update(['password' => Hash::make($request->get('password_reset_profile'))]);

        $this->email = auth()->user()['email'];
        $token = app('auth.password.broker')->createToken(auth()->user());

        // notificar
        try {
            // enviar notificação por e-mail
            $this->notify(new EditUser($token, $collection, $original));

            $data = NotifyHelpers::success_top_center('fas fa-key', 'Senha alterada com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::info_top_center('fas fa-exclamation-triangle', 'Senha alterada com sucesso, porém o envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }

    /**
     * Enviar e-mail para o recurso especificado.
     *
     * @param SendSupportRequest $request
     * @return JsonResponse
     */
    public function support(SendSupportRequest $request)
    {
        // notificar
        try {
            // enviar notificação por e-mail
            $this->email = 'felipesales007@hotmail.com';
            $this->notify(new SendSupport(auth()->user(), $request));

            $data = NotifyHelpers::success_top_center('fas fa-envelope', 'E-mail enviado com sucesso.');
        } catch (Exception $e) {
            $data = NotifyHelpers::warning_top_center('fas fa-exclamation-triangle', 'O envio de e-mail falhou.<br><br><small><b>erro: </b>' . $e->getMessage() . '</small>');
        }

        return response()->json($data);
    }
}
