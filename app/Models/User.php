<?php

namespace App\Models;

use App\Models\Post;
use GuzzleHttp\Psr7\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
       return $this->hasMany(Post::class);
    }

    public function profile()
    {
       return $this->hasOne(Profile::class);
    }

    public function can_comment()
    {
    return   $this->belongsToMany(Post::class,'comments', 'user_id', 'post_id')->withTimestamps();
    }

    public function can_like( )
    {
       return $this->belongsToMany(Post::class, 'likes', 'user_id','post_id');
    }

    ///that followes
    public function canFollow()
    {
      return $this->belongsToMany(User::class, 'follows', 'user_id_1', 'user_id_2');
    }

    public function gets_followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id_2', 'user_id_1');
    }
}

