<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users_access extends Authenticatable implements JWTSubject
{
    protected $table = 'users_access';
    
    protected $fillable = [
        'email', 
        'pass',
        'nombre',
        'apellido',
        'cedula',
        'nacimiento',
        'tipo_usuario'
    ];

    protected $hidden = [
        'pass',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}