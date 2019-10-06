<?php

namespace App\Models\Company;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'corporate_name', 'cnpj', 'email', 'contact',
        'postal_code', 'address', 'house_number', 'complement',
        'neighborhood', 'city', 'state_id', 'country', 'logo',
        'last_update_at', 'blocked_at', 'blocked', 'deleted_at'
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
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getCompanies()
    {
        return Company::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return Company
     */
    static function getCompany($id)
    {
        return Company::find($id);
    }

    /**
     * Retornar a contagem de todos os dados no armazenamento.
     *
     * @return mixed
     */
    static function getCount()
    {
        return Company::count();
    }

    /**
     * Retornar a contagem de todos os dados com e-mail cadastrado no armazenamento.
     *
     * @return mixed
     */
    static function getCountEmail()
    {
        return Company::where('email', '!=', null)->count();
    }

    /**
     * Retornar a contagem de todos os dados com contato cadastrado no armazenamento.
     *
     * @return mixed
     */
    static function getCountContact()
    {
        return Company::where('contact', '!=', null)->count();
    }

    /**
     * Retornar a contagem de todos os dados bloqueados no armazenamento.
     *
     * @return mixed
     */
    static function getCountBlocked()
    {
        return Company::where('blocked', '!=', null)->orWhere('blocked_at', '>=', date('Y-m-d'))->count();
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getCompaniesOptions()
    {
        $options = Company::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->name;
        }

        return $array;
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
}
