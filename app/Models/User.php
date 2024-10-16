<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'name', 'password', 'role', 'isArchived'];
    protected $hidden = ['password', 'remember_token'];

    public static function validateUserData($data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    }
}
