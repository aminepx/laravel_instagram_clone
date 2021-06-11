<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
public function feed()
{
    $posts=Post::all();
    $users=User::all();
    return view('pages/feed',['posts'=>$posts] ,['users'=>$users]);
}


public function postPage()
{
    return view('pages/newPost');
}

public function store(Request $req)
{
    $post=new Post();
    $post->title=$req->caption;

if ($req->hasFile('image')) {
    $path=$req->image->store('photos');
}
$post->photo=$path;
$post->user_id=Auth::user()->id;
$post->save();
return redirect('profile');

}

public function deleted($id)
{
   $post=Post::find($id);
   $post->delete();
   return back();
}

public function editPost($id)
{
    $post=Post::find($id);
    return view('pages.editPost',['post'=>$post]);

}

public function updatePost(Request $req ,$id)
{
    $post=Post::find($id);
    $post->title=$req->caption;
    if ($req->hasFile('image')) {
       $path=$req->image->store('photos');
    }
    $post->photo=$path;
    $post->update();
    return redirect('/');
}

//////comments

public function storeComment(Request $req, $id)
{
 $user=User::find(Auth::user()->id);
 $user->can_comment()->attach($id,["content"=>$req->content]);
 return back();
}

/////likes

public function likes(Request $req)
{
  $user=User::find(Auth::user()->id);
          
  $user->can_like()->attach(Auth::user()->id, ["post_id"=>$req->like]);
  return back();
}

///dislike
public function unlike(Request $req)
{
    $user=User::find(Auth::user()->id);
    $user->can_like()->detach( ["post_id"=>$req->like]);
    return back();
}


}
