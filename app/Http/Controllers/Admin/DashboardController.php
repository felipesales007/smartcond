<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return view('admins.dashboard');
    }

    /**
     * @return array
     */
    public function data()
    {
        $data = [
            'counts'  => $this->getCounts(),
            'added'   => $this->getMonthstData(),
            'genders' => $this->getGendersCount()
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function getCounts()
    {
        $cards = [
            'getCount'                => User::where('admin', '=', '1')->count(),
            'getCountConfirmation'    => User::where('admin', '=', '1')->where('email_verified_at', '!=', null)->count(),
            'getCountNotConfirmation' => User::where('admin', '=', '1')->where('email_verified_at', '=', null)->count(),
            'getCountBlocked'         => User::where('admin', '=', '1')->where('blocked', '!=', null)->orWhere('blocked_at', '>=', date('Y-m-d'))->count()
        ];

        return $cards;
    }

    /**
     * @return array
     */
    public function getGendersCount()
    {
        $names = User::leftJoin('genders', 'genders.id', '=', 'gender_id')
            ->where('admin', '=', '1')
            ->orderBy('genders.id', 'asc')
            ->groupBy('genders.name')
            ->pluck('genders.name');

        if (isset($names[0])) {
            if ($names[0] == null) {
                $names[0] = 'Não selecionado';
            }
        }

        $count = User::leftJoin('genders', 'genders.id', '=', 'gender_id')
            ->where('admin', '=', '1')
            ->orderBy('genders.id', 'asc')
            ->get()
            ->groupBy('gender_id')
            ->values()
            ->map(function ($users) {
                return $users->count();
            });

        $genders = [
            'names' => $names,
            'count' => $count
        ];

        return $genders;
    }

    /**
     * @return array|Exception
     */
    public function getAllMonths()
    {
        $month_array = array();
        $dates       = User::where('admin', '=', '1')->orderBy('created_at', 'asc')->pluck('created_at');
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
        $months_count = User::where('admin', '=', '1')->whereMonth('created_at', $month)->get()->count();

        return $months_count;
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

        $months_data_array = [
            'months'       => $month_name_array,
            'count_months' => $months_count_array
        ];

        return $months_data_array;
    }
}
