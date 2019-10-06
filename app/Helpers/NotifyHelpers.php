<?php

namespace App\Helpers;

class NotifyHelpers
{
    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function success_top_center($icon, $message)
    {
        return [
            'from'    => 'top',
            'align'   => 'center',
            'type'    => 'success',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function info_top_center($icon, $message)
    {
        return [
            'from'    => 'top',
            'align'   => 'center',
            'type'    => 'info',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function warning_top_center($icon, $message)
    {
        return [
            'from'    => 'top',
            'align'   => 'center',
            'type'    => 'warning',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function danger_top_center($icon, $message)
    {
        return [
            'from'    => 'top',
            'align'   => 'center',
            'type'    => 'danger',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function success_bottom_right($icon, $message)
    {
        return [
            'from'    => 'bottom',
            'align'   => 'right',
            'type'    => 'success',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function info_bottom_right($icon, $message)
    {
        return [
            'from'    => 'bottom',
            'align'   => 'right',
            'type'    => 'info',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function warning_bottom_right($icon, $message)
    {
        return [
            'from'    => 'bottom',
            'align'   => 'right',
            'type'    => 'warning',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }

    /**
     * @param $icon
     * @param $message
     * @return array
     */
    static function danger_bottom_right($icon, $message)
    {
        return [
            'from'    => 'bottom',
            'align'   => 'right',
            'type'    => 'danger',
            'icon'    => $icon,
            'title'   => 'Notificação',
            'message' => $message
        ];
    }
}
