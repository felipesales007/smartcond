<?php

namespace App\Models\Company;

use App\Models\Boolean;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyAccesses extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'company_accesses';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'user_id', 'preferred'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getCompanyAccesses()
    {
        return CompanyAccesses::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return CompanyAccesses
     */
    static function getCompanyAccess($id)
    {
        return CompanyAccesses::find($id);
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getCompany()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getPreferred()
    {
        return $this->belongsTo(Boolean::class, 'preferred');
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return CompanyAccesses
     */
    static function getCompanyAccessUser($id)
    {
        return CompanyAccesses::where('user_id', '=', $id)->first();
    }
}
