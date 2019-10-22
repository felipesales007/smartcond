<?php

namespace App\Models;

use App\Models\Entity\Entity;
use App\Notifications\Auth\PasswordReset;
use App\Notifications\Auth\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cpf', 'rg', 'email', 'email_verified_at', 'password',
        'birthday', 'contact', 'gender_id', 'course', 'college',
        'profession', 'company', 'postal_code', 'address', 'house_number',
        'complement', 'neighborhood', 'city', 'state_id', 'country',
        'description', 'photo', 'background', 'admin', 'last_login_ip',
        'last_login_at', 'last_update_at', 'blocked_at', 'blocked', 'deleted_at'
    ];

    /**
     * Os atributos de bloqueado e excluído.
     *
     * @var array
     */
    protected $dates = [
        'blocked_at', 'deleted_at'
    ];

    /**
     * Os atributos que devem estar ocultos para matrizes.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Os atributos que devem ser convertidos em tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getUsers()
    {
        return User::where('admin', '=', '0')->get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return User
     */
    static function getUser($id)
    {
        return User::where('admin', '=', '0')->find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return User::join('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
            ->where('admin', '=', '0')
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->groupBy('entity_accesses.user_id')
            ->get()
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados com e-mail confirmado no armazenamento.
     *
     * @return mixed
     */
    static function getCountConfirmation()
    {
        return User::join('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
            ->where('admin', '=', '0')
            ->where('email_verified_at', '!=', null)
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->groupBy('entity_accesses.user_id')
            ->get()
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados com e-mail não confirmado no armazenamento.
     *
     * @return mixed
     */
    static function getCountNotConfirmation()
    {
        return User::join('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
            ->where('admin', '=', '0')
            ->where('email_verified_at', '=', null)
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->groupBy('entity_accesses.user_id')
            ->get()
            ->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return User::join('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
            ->where('admin', '=', '0')
            ->where('blocked', '!=', null)
            ->where(function ($query) {
                $query->orWhere('blocked_at', '>=', date('Y-m-d'));
            })
            ->when(auth()->user()['admin'] == '0', function ($query) {
                $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
            })
            ->groupBy('entity_accesses.user_id')
            ->get()
            ->count();
    }

    /**
     * Envie a notificação de redefinição de senha.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this->name));
    }

    /**
     * Envie a notificação de confirmação por e-mail.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail($this->name));
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getUsersOptions()
    {
        $options = User::where('admin', '=', '0')->get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->name] = $option->name;
        }

        return $array;
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getGender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getAdmin()
    {
        return $this->belongsTo(Boolean::class, 'admin');
    }
}
