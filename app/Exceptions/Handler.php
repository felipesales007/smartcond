<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * Uma lista dos tipos de exceção que não são relatados.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Uma lista das entradas que nunca são exibidas para exceções de validação.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Relate ou registre uma exceção.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Renderize uma exceção em uma resposta HTTP.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
