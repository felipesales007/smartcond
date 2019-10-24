<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CheckController extends Controller
{
    /**
     * Verificar se a senha está correta no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkPassword(Request $request)
    {
        $collection = User::where('id', '=', auth()->user()['id'])->value('password');

        if (Hash::check($request->password, $collection)) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
