<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class replies_comments extends Model
{
    use HasFactory;
    protected $table = "replies_comments";
    protected $fillable = [
        "user_id",
        "comment_id",
        "komentar"
    ];
    public function comment()
    {
        return $this->belongsTo(comments::class, "comment_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function like_replies_comments()
    {
        return $this->hasMany(like_replies_comments::class, "reply_comment_id");
    }
    public function isLikeReplyComment(string $id)
    {
        return like_replies_comments::where("user_id", $id)
        ->where("reply_comment_id", $this->id)
        ->exists();
    }
    public function countLikeReplyComment()
    {
        return like_replies_comments::where("reply_comment_id", $this->id)
        ->count();
    }
}
