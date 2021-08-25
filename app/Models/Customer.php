<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name','photo','phone','email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * invoice
     *
     * @return void
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    /**
     * carts
     *
     * @return void
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
        
    /**
     * getJWTCustomClaims
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}