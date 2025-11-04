<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime','password'=>'hashed'];
    protected $attributes = ['role' => 'user'];

    public function isAdmin() {
        return $this->role === 'admin';
    }

    // ✅ Relations
    public function books() {
        return $this->hasMany(Book::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
