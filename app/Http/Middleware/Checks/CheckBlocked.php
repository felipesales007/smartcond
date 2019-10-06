<?php

namespace App\Http\Middleware\Checks;

use App\Helpers\FormatHelpers;
use App\Models\Company\CompanyAccesses;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\RedirectResponse;

class CheckBlocked
{
    /**
     * Lidar com uma solicitação recebida.
     *
     * @param $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $company = CompanyAccesses::select('companies.blocked as blocked',
            'companies.blocked_at as blocked_at', 'companies.deleted_at as deleted_at')
            ->join('companies', 'companies.id', '=', 'company_accesses.company_id')
            ->where('user_id', '=', auth()->id())
            ->get();

        // se logado verifica
        if (auth()->check()) {
            // se a empresa deletada
            if ($company->where('deleted_at', '=', null)->count() == 0) {
                auth()->logout();
                $message = 'A empresa relacionada com o seu usuário não existe mais no sistema.';

                return redirect()->route('login')->with('status', __($message));
            }

            // se a empresa bloqueada
            if ($company->where('blocked', '=', null)->count() == 0) {
                auth()->logout();
                $message = 'A empresa relacionada com o seu usuário está desativada.';

                return redirect()->route('login')->with('status', __($message));
            }

            // se a empresa bloqueada por tempo determinado
            if ($company->where('blocked_at', '=', null)->count() == 0) {
                $days = array_values($company->where('blocked_at', '!=', null)->toArray());
                $date = null;

                for ($i = 0; $i < count($days); $i++) {
                    if ($date < $days[$i]['blocked_at']) {
                        $date = $days[$i]['blocked_at'];
                    }
                }

                $date = Carbon::parse($date);

                if ($date->toDateString() >= date('Y-m-d')) {
                    $time = now()->diffForHumans($date->addDays(1)->toDateString());
                    auth()->logout();

                    $message = 'A empresa relacionada com o seu usuário foi bloqueada.<br>Será desbloqueada depois de ' . FormatHelpers::remove_last_word(' antes', $time) . '.';

                    return redirect()->route('login')->with('status', __($message));
                }
            }

            // se o usuário bloqueado
            if (auth()->user()['blocked']) {
                auth()->logout();
                $message = 'Esta conta está desativada.';

                return redirect()->route('login')->with('status', __($message));
            }

            // se o usuário bloqueado por tempo determinado
            if (isset(auth()->user()['blocked_at'])) {
                if (auth()->user()['blocked_at']->toDateString() >= date('Y-m-d')) {
                    $time = now()->diffForHumans(auth()->user()['blocked_at']->addDays(1)->toDateString());
                    auth()->logout();

                    $message = 'Sua conta foi bloqueada.<br>Será desbloqueada depois de ' . FormatHelpers::remove_last_word(' antes', $time) . '.';

                    return redirect()->route('login')->with('status', __($message));
                }
            }
        }

        return $next($request);
    }
}
