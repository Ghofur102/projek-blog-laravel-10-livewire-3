<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function blogs()
    {
        return $this->hasMany(blogs::class, "user_id");
    }
    public function comments()
    {
        return $this->hasMany(comments::class, "user_id");
    }
    public function likes_comments()
    {
        return $this->hasMany(likes_comments::class, "user_id");
    }
    public function replies_comments()
    {
        return $this->hasMany(replies_comments::class, "user_id");
    }
    public function like_replies_comments()
    {
        return $this->hasMany(like_replies_comments::class, "user_id");
    }
}
