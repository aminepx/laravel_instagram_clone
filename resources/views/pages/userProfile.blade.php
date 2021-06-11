@extends('layouts.app1')

@section('content')
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>
    profile</title></head>
<main class="profile-container">
    <section class="profile">
        <header class="profile__header">
            <div class="profile__avatar-container">

              
                      <img 
                    src="{{asset('storage/'.$user->profile->image) }}"
                    class="profile__avatar"
                />
           
            </div>
            <div class="profile__info">
                <div class="profile__name">
                    <h1 class="profile__title">{{$user->profile->username}}</h1>

                @if (Auth::user()->canFollow()->where('user_id_2',$user->id)->first())
                <form action="{{route('unfollow')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="unfollow">
                    <button class="btn btn-primary">unfollow</button>
                </form> 
                @else
                <form action="{{route('follow')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="follow">
                    <button class="btn btn-primary">Follow</button>
                </form>
                @endif

                </div>
                <ul class="profile__numbers">
                    <li class="profile__posts">
                        <span class="profile__number u-fat-text">{{count($posts)}}</span> posts
                    </li>
                 
                    <li class="profile__followers">
                        <span class="profile__number u-fat-text">
                               
                            {{$user->gets_followed()->count()}}
                         
                        
                        </span> followers
                    </li>
                    <li class="profile__following">
                        <span class="profile__number u-fat-text">{{$user->canFollow()->count()}}</span> following
                    </li>
          
                </ul>
                <div class="profile__bio">
                    <span class="profile__full-name u-fat-text">{{$user->profile->username}}</span><br>
                    {{-- bio --}}
                    <p class="profile__full-bio">{{$user->profile->bio}}</p><br>
                    <a href="http://serranoarevalo.com" class="profile__link u-fat-text">{{$user->profile->website}}</a>
                </div>
            </div>
        </header>
        <div class="profile__pictures">

            


            @forelse ($posts as $post)
            <a href="image-detail.html" class="profile-picture">
                <style>
                    .post_img{
                        width: 300px;
                      height: 300px;
                    }
                </style>
                <img
                    src="{{asset('storage/'.$post->photo)}}"
                    class="post_img profile-picture__picture"
                   
                />
                <div class="profile-picture__overlay">
                    <span class="profile-picture__number">
                        <i class="fa fa-heart"></i> {{$post->has_Likes->count()}}
                    </span>
                    <span class="profile-picture__number">
                        <i class="fa fa-comment"></i> {{$post->has_comments->count()}}
                    </span>
                </div>
            </a>
            @empty
                <h1 class="text-center text-secondary m-5">No Posts yet</h1>
            @endforelse
            
           
        </div>
    </section>
</main>
@endsection