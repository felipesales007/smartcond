<?php

namespace App\Http\Controllers\Management\User;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Entity\Entity;
use App\Models\User\User;
use DateTime;
use Exception;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Mostrar a página solicitada.
     *
     * @return Factory|View
     */
    public function dashboard()
    {
        $page = PageHelpers::page('17');
        $list = PageHelpers::page('18');

        return view('management.users.dashboard.page', compact('page', 'list'));
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'counts'  => $this->getCounts(),
            'added'   => $this->getMonthstData(),
            'genders' => $this->getGendersCount()
        ];
    }

    /**
     * @return array
     */
    public function getCounts()
    {
        return [
            'getCount' => User::leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
                ->where('admin', '=', '0')
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->groupBy('entity_accesses.user_id')
                ->get()
                ->count(),

            'getCountConfirmation' => User::leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
                ->where('admin', '=', '0')
                ->where('email_verified_at', '!=', null)
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->groupBy('entity_accesses.user_id')
                ->get()
                ->count(),

            'getCountNotConfirmation' => User::leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
                ->where('admin', '=', '0')
                ->where('email_verified_at', '=', null)
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->groupBy('entity_accesses.user_id')
                ->get()
                ->count(),

            'getCountBlocked' => User::leftJoin('entity_accesses', 'entity_accesses.user_id', '=', 'users.id')
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
                ->count(),
        ];
    }

    /**
     * @return array
     */
    public function getGendersCount()
    {
        $names = User::leftJoin('genders', 'genders.id', '=', 'gender_id')
            ->where('admin', '=', '0')
            ->orderBy('genders.id', 'asc')
            ->groupBy('genders.name')
            ->pluck('genders.name');

        if (isset($names[0])) {
            if ($names[0] == null) {
                $names[0] = 'Não selecionado';
            }
        }

        $count = User::leftJoin('genders', 'genders.id', '=', 'gender_id')
            ->where('admin', '=', '0')
            ->orderBy('genders.id', 'asc')
            ->get()
            ->groupBy('gender_id')
            ->values()
            ->map(function ($users) {
                return $users->count();
            });

        return [
            'names' => $names,
            'count' => $count
        ];
    }

    /**
     * @return array|Exception
     */
    public function getAllMonths()
    {
        $month_array = array();
        $dates       = User::where('admin', '=', '0')->orderBy('created_at', 'asc')->pluck('created_at');
        $dates       = json_decode($dates);

        if (!empty($dates)) {
            foreach ($dates as $unformatted_date) {
                try {
                    $date       = new DateTime($unformatted_date);
                    $month_no   = $date->format('m');
                    $month_name = strftime('%b', $date->getTimestamp());

                    $month_array[$month_no] = $month_name;
                } catch (Exception $e) {
                    return $e;
                }
            }
        }

        return $month_array;
    }

    /**
     * @param $month
     * @return mixed
     */
    public function getMonthsCount($month)
    {
        return User::where('admin', '=', '0')->whereMonth('created_at', $month)->get()->count();
    }

    /**
     * @return array
     */
    public function getMonthstData()
    {
        $month_name_array   = array();
        $months_count_array = array();
        $month_array        = $this->getAllMonths();

        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $months_count = $this->getMonthsCount($month_no);

                array_push($months_count_array, $months_count);
                array_push($month_name_array, $month_name);
            }
        }

        return [
            'months'       => $month_name_array,
            'count_months' => $months_count_array
        ];
    }
}
