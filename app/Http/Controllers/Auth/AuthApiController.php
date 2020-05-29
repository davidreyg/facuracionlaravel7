<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class AuthApiController extends ApiController
{
    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"auth"},
     *     operationId="login",
     *     summary="Iniciar sesion para obtener un token de acceso.",
     *     @OA\RequestBody(
     *         description="Credenciales del usuario (username, password)",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Datos invalidos!",
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful pues :3",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function login(Request $request)
    {
        $token = null;
        $credentials = request(['username', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse('Usuario o password incorrectos', 401);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse('No se pudo generar el token', 500);
        }
        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(['data' => auth()->user()]);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $header = $request->header('Authorization');

        if ($header) {
            try {
                auth()->logout();

                return response()->json([
                    'success' => true,
                    'message' => 'Sesion cerrada satisfactoriamente'
                ]);
            } catch (JWTException $exception) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, the user cannot be logged out'
                ], 500);
            }
        }
        $this->errorResponse('No existe el token en la cabecera', 500);
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = JWTAuth::fromUser($user);
        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires' => JWTAuth::factory()->getTTL(),
        ])->header('Authorization', $token);;
    }
}
