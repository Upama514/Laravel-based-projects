<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory; // optional but recommended for seeding/testing

    // 🧩 Mass assignable fields (title, content, user_id)
    protected $fillable = ['title', 'content', 'user_id'];
    
    /**
     * 🧠 Relationship: Each Blog belongs to one User
     * অর্থাৎ প্রতিটা Blog এর মালিক থাকে একজন user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
