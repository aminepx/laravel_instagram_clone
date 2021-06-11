<?php

namespace App\Models;

use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
     return  $this->belongsTo(User::class);
    }

    public function has_comments()
    {
   return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id')->withPivot('content','user_id');
    }

    public function has_Likes()
    {
        return $this->belongsToMany(ModelsUser::class, 'likes', 'post_id','user_id')->withPivot('post_id', 'user_id');
    }
}
