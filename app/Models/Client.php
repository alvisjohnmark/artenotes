<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'province', 'city/municipality', 'barangay', 'zipcode', 'street'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
