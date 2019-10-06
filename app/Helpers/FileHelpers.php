<?php

namespace App\Helpers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\File;

class FileHelpers
{
    /**
     * @param $name
     * @param $type
     * @return UrlGenerator|string
     */
    static function destination_url($name, $type)
    {
        $variable = '-' . implode('-', explode(':', now()->toTimeString())) . '.';
        $url = md5($name) . $variable . $type;

        return $url;
    }

    /**
     * @param $request
     * @param $delete
     * @param $file
     * @param $input
     * @param $destination
     */
    static function destination_file($request, $delete, $file, $input, $destination)
    {
        if (strpbrk($input, '0123456789')) {
            $url = $input;
        } else {
            $url = $request->input($input);
        }

        if (preg_match('/localhost/', url('/')) || preg_match('/127.0.0.1/', url('/')) || preg_match('/127.0.0.1:8000/', url('/'))) {
            $path = storage_path('app/public/' . $destination);
        } else {
            $path = public_path('storage/' . $destination);
        }

        $old  = basename($delete);
        $name = implode('-', explode(':', basename($url)));

        if ($request->hasFile($file) && $request->file($file)->isValid()) {
            File::delete($path . $old);
            $request->file($file)->move($path, $name);
        } else if (!$url) {
            File::delete($path . $old);
        } else if ($old == null || !file_exists($path . $old)) {
            $request->request->add([$input => null]);
        } else {
            $request->request->add([$input => $old]);
        }
    }
}
