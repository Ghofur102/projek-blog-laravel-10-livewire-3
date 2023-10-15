<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $fillable = [
        "user_id",
        "judul_blog",
        "foto",
        "isi_blog"
    ];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function comments()
    {
        return $this->hasMany(comments::class, "blog_id");
    }
}
