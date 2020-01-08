<?php

namespace App\Models\Condominium;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CondominiumApartmentParking extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'condominium_apartment_parkings';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'apartment_id', 'parking_id'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getCondominiumApartmentParkings()
    {
        return CondominiumApartmentParking::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return CondominiumApartmentParking
     */
    static function getCondominiumApartmentParking($id)
    {
        return CondominiumApartmentParking::find($id);
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getApartment()
    {
        return $this->belongsTo(CondominiumApartment::class, 'apartment_id');
    }

    /**
     * Atributo de referência do join.
     *
     * @return BelongsTo
     */
    public function getParking()
    {
        return $this->belongsTo(CondominiumParking::class, 'parking_id');
    }
}
