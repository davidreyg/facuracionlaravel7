<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
/**
 * @OA\Schema()
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="username",
     *   type="string",
     *   description="username del usuario"
     * )
     */
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="password",
     *   type="string",
     *   description="password del usuario"
     * )
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
