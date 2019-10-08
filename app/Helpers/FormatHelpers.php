<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FormatHelpers
{
    /**
     * @param $date
     * @return string
     */
    static function date_br_to_date($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }

    /**
     * @param $date
     * @return string
     */
    static function date_to_date_br($date)
    {
        return implode('/', array_reverse(explode('-', $date)));
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_now($date)
    {
        return implode('-', array_reverse(explode('/', $date))) . ' ' . now()->toTimeString();
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_zero($date)
    {
        return implode('-', array_reverse(explode('/', $date))) . ' 00:00:00';
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_day($date)
    {
        return implode('-', array_reverse(explode('/', $date))) . ' 23:59:59';
    }

    /**
     * @param $date
     * @return string
     */
    static function datetime_to_date($date)
    {
        return Str::limit($date, 10, '');
    }

    /**
     * @param $date
     * @return string
     */
    static function datetime_to_date_br($date)
    {
        return implode('/', array_reverse(explode('-', Str::limit($date, 10, ''))));
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $format
     * @return false|string
     */
    static function random_date($startDate, $endDate, $format)
    {
        return date($format, mt_rand(strtotime($startDate), strtotime($endDate)));
    }

    /**
     * @param $word
     * @return string
     */
    static function first_word($word)
    {
        return strtok($word, ' ');
    }

    /**
     * @param $word
     * @return string
     */
    static function two_word($word)
    {
        if ($word != null) {
            if (count(explode(' ', $word)) > 1) {
                list($first, $second) = explode(' ', $word);
                return $first . ' ' . $second;
            } else {
                return $word;
            }
        }
    }

    /**
     * @param $name
     * @return string
     */
    static function image_name($name)
    {
        return md5($name) . '-' . implode('-', explode(':', basename(now()->toTimeString()))) . '.png';
    }

    /**
     * @param $after
     * @param $string
     * @param $change
     * @return string
     */
    static function change_last_word_after($after, $string, $change)
    {
        $last = explode($after, $string);
        $last = $last[count($last) - 1];

        return implode($change, explode($last, $string));
    }

    /**
     * @param $after
     * @param $string
     * @param $change
     * @return string
     */
    static function change_last_word_if_number($after, $string, $change)
    {
        $last = explode($after, $string);
        $last = is_numeric($last[count($last) - 1]) ? $last[count($last) - 1] : null;

        if ($last) {
            return implode($change, explode($last, $string));
        } else {
            return $string;
        }
    }

    /**
     * @param $remove
     * @param $string
     * @return string
     */
    static function remove_last_word($remove, $string)
    {
        return Str::replaceLast($remove, '', $string);
    }

    /**
     * @param $route
     * @return string
     */
    static function standardize_route($route)
    {
        $last = explode('/', $route);
        $last = is_numeric($last[count($last) - 1]) ? $last[count($last) - 1] : null;

        if ($last) {
            return Str::replaceLast('/', '', implode('', explode($last, $route)));
        } else {
            return $route;
        }
    }

    /**
     * @param $value
     * @return string
     */
    static function to_usd($value)
    {
        $formater = $value;
        $formater = str_replace('.', '', $formater);
        $formater = str_replace(',', '.', $formater);

        return $formater;
    }
}
