<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
