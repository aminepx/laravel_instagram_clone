@extends('layouts.app1')

@section('content')

<head>
  
    <title>edit post | Instaclone</title>


</head>


    <section class="login">
        <div class="offset-4">
            <img 
                src="{{asset('images/logo.png')}}"
                alt="Logo"
                title="Logo"
                class="login__logo"
            />
<form action="{{route('updatePost',['id'=>$post->id])}}" method="POST" class="" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="">
        <input 
        type="file" 
        name="image" 
        value="{{ old('image') }}" 
        required 
        placeholder="image" 
        autofocus 
        class="login__input" />
    </div>
   
    <div class="">
        <input  id="email" 
        type="text" 
         name="caption" 
         placeholder="caption"
        value="{{$post->title }}" 

         required 
         autocomplete="current-password" 
         class="login__input" 
        />
   
    <div class="">
        <input
            type="submit"
            value="Post"
            class="login__input login__input--btn"
        />
    </div>
</form>
</div>
</section>


@endsection