<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class Admin extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, HasFactory, Authenticatable, Authorizable;

    protected $table = 'admins';

    protected $fillable = [
        'first_name', 
        'last_name',
        'gender',
        'phone',
        'email',
        'password',
        'is_active',
        'is_blocked',
        'role',
        'image_url',
        'address_id',
        'verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
