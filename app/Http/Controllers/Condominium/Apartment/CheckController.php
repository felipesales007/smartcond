<?php

namespace App\Http\Controllers\Condominium\Apartment;

use App\Models\Condominium\CondominiumApartment;
use App\Models\Entity\Entity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    /**
     * Verificar se o nome já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkName(Request $request)
    {
        $collection = CondominiumApartment::withTrashed()
            ->where('entity_id', '=', Entity::id())
            ->where('block_id', '=', $request->block)
            ->where('name', '=', $request->name)
            ->value('name');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o nome diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkNameDifferent(Request $request)
    {
        $myCollection = CondominiumApartment::withTrashed()
            ->where('entity_id', '=', Entity::id())
            ->where('block_id', '=', $request->block)
            ->where('id', '=', $request->id)
            ->value('name');

        $verifyCollection = CondominiumApartment::withTrashed()
            ->where('entity_id', '=', Entity::id())
            ->where('block_id', '=', $request->block)
            ->where('name', '=', $request->name)
            ->value('name');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
