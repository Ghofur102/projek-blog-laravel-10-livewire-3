<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $fillable = [
        "user_id",
        "blog_id",
        "komentar"
    ];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function blog()
    {
        return $this->belongsTo(blogs::class, "blog_id");
    }
    public function likes_comments()
    {
        return $this->hasMany(likes_comments::class, "comment_id");
    }
    public function isLikeComment(string $user_id)
    {
        return likes_comments::where("user_id", $user_id)
        ->where("comment_id", $this->id)
        ->exists();
    }
    public function countLikeComment()
    {
        return likes_comments::where("comment_id", $this->id)
        ->count();
    }
    public function replies_comments()
    {
        return $this->hasMany(replies_comments::class, "comment_id");
    }
    public function countReplyComment()
    {
        return replies_comments::where("comment_id", $this->id)->count();
    }
}
