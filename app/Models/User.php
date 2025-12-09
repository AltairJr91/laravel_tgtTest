<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject

{
    use SoftDeletes, HasRoles, HasFactory;

    protected $fillable = ['name', 'email', 'cpf', 'phone', 'password'];

    protected $hidden = ['password'];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
