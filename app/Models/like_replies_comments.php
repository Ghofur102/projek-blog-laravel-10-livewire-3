<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like_replies_comments extends Model
{
    use HasFactory;
    protected $table = "like_replies_comments";
    protected $fillable = [
        "user_id",
        "reply_comment_id"
    ];
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function reply_comment()
    {
        return $this->belongsTo(replies_comments::class, "reply_comment_id");
    }
}
