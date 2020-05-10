<?php

namespace App\Exceptions;

use Exception;
use App\Http\Utils\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Dingo\Api\Exception\Handler as DingoHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class ApiHandler extends DingoHandler
{
    use ApiResponser;
    public function handle($exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontro la URL especificada', 404);
        }

        if ($exception instanceof ModelNotFoundException) {
            // dd($exception);
            $modelo = strtolower(class_basename($exception->getModel()));
            if (count($exception->getIds()) >1) {
                $ids = $exception->getIds();
            }else{
                $ids = $exception->getIds()[0];
            }
            return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id '{$ids}'", 404);
        }

        if ($exception instanceof AuthenticationException) {
            // return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse("No posee permisos para ejecutar esta accion", 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse("El metodo especificado en la petición no es valido", 405);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->errorResponse("El token ha expirado", 401);
            } else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->errorResponse("El token no es valido", 401);
            } else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return $this->errorResponse("Token BLACKLISTED", 401);
            }
            if ($exception->getMessage() === 'Token not provided') {
                return $this->errorResponse("Inserta tu token pues hermano!", 401);
            }
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        // dd($exception);
        if (config('app.debug')) {
            return parent::handle($exception);
        }

        return $this->errorResponse("Falla inesperada en MATRIX. Intente mas tarde.", 500);
    }
}
