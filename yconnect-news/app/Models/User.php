<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    public $incrementing = true;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'slug', 'username', 'email', 'password'
    ];

    public function post()
    {
        return $this->hasMany(Posts::class);
    }

    public function category()
    {
        return $this->hasMany(Categories::class);
    }
}
