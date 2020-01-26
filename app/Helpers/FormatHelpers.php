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
        return $date ? implode('-', array_reverse(explode('/', $date))) : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function date_to_date_br($date)
    {
        return $date ? implode('/', array_reverse(explode('-', $date))) : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_now($date)
    {
        return $date ? implode('-', array_reverse(explode('/', $date))) . ' ' . now()->toTimeString() : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_zero($date)
    {
        return $date ? implode('-', array_reverse(explode('/', $date))) . ' 00:00:00' : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function date_br_to_datetime_day($date)
    {
        return $date ? implode('-', array_reverse(explode('/', $date))) . ' 23:59:59' : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function datetime_to_date($date)
    {
        return $date ? Str::limit($date, 10, '') : null;
    }

    /**
     * @param $date
     * @return string
     */
    static function datetime_to_date_br($date)
    {
        return $date ? implode('/', array_reverse(explode('-', Str::limit($date, 10, '')))) : null;
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
        return $word ? strtok($word, ' ') : null;
    }

    /**
     * @param $word
     * @return string
     */
    static function two_word($word)
    {
        if ($word) {
            if (count(explode(' ', $word)) > 1) {
                list($first, $second) = explode(' ', $word);
                return $first . ' ' . $second;
            } else {
                return $word;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @return string
     */
    static function image_name($name)
    {
        return $name ? md5($name) . '-' . implode('-', explode(':', basename(now()->toTimeString()))) . '.png' : null;
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
        return $string ? Str::replaceLast($remove, '', $string) : null;
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
        if ($value) {
            $format = $value;
            $format = str_replace('.', '', $format);
            $format = str_replace(',', '.', $format);

            return $format;
        } else {
            return null;
        }
    }

    /**
     * @param $value
     * @return string
     */
    static function to_real($value)
    {
        if ($value) {
            $format = $value;
            $format = str_replace(',', '', $format);
            $format = str_replace('.', ',', $format);

            return $format;
        } else {
            return null;
        }
    }

    /**
     * @param $value
     * @param $quantity
     * @return string|null
     */
    static function zero_left($value, $quantity = '2')
    {
        return $value ? str_pad($value, $quantity, '0', STR_PAD_LEFT) : null;
    }

    /**
     * @param $value
     * @return array|string|null
     */
    static function remove_zero_left($value)
    {
        if ($value) {
            if (strpos($value, '.')) {
                $value = explode('.', $value);
                if (count($value) == 2) {
                    $value = ltrim($value[0], '0') . '.' . ltrim($value[1], '0');
                } else if(count($value) == 3) {
                    $value = ltrim($value[0], '0') . '.' . ltrim($value[1], '0') . '.' . ltrim($value[2], '0');
                }
            } else {
                $value = ltrim($value, '0');
            }

            return $value;
        } else {
            return null;
        }
    }

    /**
     * @param $string
     * @param int $quantity
     * @return bool|false|string|string[]|null
     */
    static function limiter($string, $quantity = 50)
    {
        return $string ? mb_convert_encoding(substr_replace($string, (strlen($string) > $quantity ? '...' : ''), $quantity), 'utf-8') : null;
    }
}
