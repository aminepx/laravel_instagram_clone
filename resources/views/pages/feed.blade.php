@extends('layouts.app1')
@section('content')
    
<head><title>feed</title>
<!-- CSS only -->

</head>

<main class="feed parent">
   @foreach ($posts as $post)
   <section class="photo">
    <header class="photo__header">
        <div class="photo__header-column">
            @foreach ($users as $user)
                @if ($user->id == $post->user_id)                 
                <img
                    class="photo__avatar"
                    src="{{asset('storage/'.$user->profile->image)}}"
                />
                @endif
            @endforeach
        </div>
        <div class="photo__header-column">
            @if (Auth::user()->id==$post->user_id)
                <a href="{{route('profile')}}">  <span class="photo__username">{{$post->user->name}}</span></a>
            @else
            <a href="{{route('userProfile',['id'=>$post->user_id])}}">  <span class="photo__username">{{$post->user->name}}</span> </a>
            @endif
          
            <span class="photo__location">European Art of Living Center - Bad Antogast</span>
        </div>
    </header>
    @if ($post->user_id== Auth::user()->id)
    <div class="d-flex">
    <form action="{{route('deletePost',['id'=>$post->id])}}" method="post">
@method('DELETE')
@csrf
        <button class="btn btn-sm btn-secondary"><i class="fas fa-trash"></i></button>
    </form>
        <a href="{{route('editPost',['id'=>$post->id])}}" class="btn btn-sm btn-secondary "><i class="fas fa-edit"></i></a>
    </div>
    @endif
    <div class="photo__file-container">
        <img
            class="photo__file"
            src="{{asset('storage/'.$post->photo)}}"
        />
    </div>
    <div class="photo__info">
        <div class="photo__icons d-flex ">
            {{-- //like button --}}
          

                      
         @if ( $post->has_Likes()->where('user_id',Auth::user()->id)->first())             
     
         <form action="{{route('unlike')}}" method="post" class=" ">
            @csrf
            <input type="hidden" name="like" value="{{$post->id}}"> 
            <button class="btn text-danger">
                <span id ="heart"><i style="color:red;cursor:pointer;font-size:24px;margin-right:10px" class="fa fa-heart" aria-hidden="true" ></i> </span>
            </button>
        </form>
        @else      
      
        
        <form action="{{route('likes')}}" method="post" class="hereLike">
            @csrf
            <input type="hidden" name="like" value="{{$post->id}}"> 
            <button class="btn ">
                <span id ="heart"><i  style="color:rgb(0, 0, 0);cursor:pointer;font-size:24px;margin-right:10px" class="fa fa-heart-o fs-5" aria-hidden="true" ></i> </span>
            </button>
        </form>

        @endif 
      
           
         
     
            <span class="photo__icon">
                <i class="fa fa-comment-o fa-lg m-2"></i>
            </span>
        </div>
        <span class="photo__likes">{{count($post->has_Likes)}} likes</span>
        <ul class="photo__comments">
@foreach ($post->has_comments as $comment)
<li class="photo__comment">
    {{-- //username --}}
    <span class="photo__comment-author">
       @foreach ($users as $user)
       @if ($user->id==$comment->pivot->user_id)
           
       {{$user->profile->username}}
       @endif
       @endforeach
   </span>
   {{-- end username --}}
   {{-- //comment --}}
   {{ $comment->pivot->content}}
</li>
@endforeach
           
        </ul>
        <span class="photo__time-ago">{{$post->created_at->diffForHumans(null, false, true)}}</span>
        
        <div class="photo__add-comment-container">
         {{-- comment --}}
            <form action="{{route('storeComment',['id'=>$post->id])}}" method="post" class="d-flex">              
                @csrf
                <textarea name="content" placeholder="Add a comment..." class="photo__add-comment"></textarea>
               <button class="btn text-primary">Post</button> 
            </form>
        </div>
    </div>
</section>
   @endforeach
  
</main>

{{-- 
<script>

    document.querySelector('.parent').addEventListener('click', (event)=> {
       
        let like=event.target.classList.contains('hereLike');
        

        if (like) {
            
            alert('hi');
        }
    })
</script> --}}
@endsection
