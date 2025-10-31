<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'author', 'description'];

    // ✅ একটি Book একটি User-এর belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // ✅ একটি Book-এর অনেকগুলি Comment থাকতে পারে
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }

}
