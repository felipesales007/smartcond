<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthPicture extends Model
{
    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'auth_pictures';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'image', 'title', 'description'
    ];

    /**
     * Retornar todos os dados do armazenamento.
     *
     * @return array
     */
    static function getAuthPictures()
    {
        return AuthPicture::get();
    }

    /**
     * Retornar o dado especificado no armazenamento.
     *
     * @param $id
     * @return AuthPicture
     */
    static function getAuthPicture($id)
    {
        return AuthPicture::find($id);
    }

    /**
     * Retornar todas as opções dos dados do armazenamento.
     *
     * @return array
     */
    static function getAuthPicturesOptions()
    {
        $options = AuthPicture::get();
        $array   = [];

        foreach ($options as $option) {
            $array[$option->id] = $option->image;
        }

        return $array;
    }

    /**
     * Retornar um dado aleatória do armazenamento.
     *
     * @return mixed
     */
    static function getRandAuthPicture()
    {
        $count  = AuthPicture::count();
        $number = rand(1, $count);
        $data   = AuthPicture::where('number', $number)->get();

        return $data;
    }
}
