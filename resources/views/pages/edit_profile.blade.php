@extends('layouts.app1')
@section('content')
    
<main class="edit-profile">
    <section class="profile-form">
        <header class="profile-form__header">
            <div class="profile-form__avatar-container">
                <img 
                    src="{{asset('storage/'.$profile->image)}}"
                    class="profile-form__avatar"
                />
            </div>
            <h4 class="profile-form__title">{{Auth::user()->name}}</h4>
        </header>
        <form action="{{route('updateProfile',['id'=>Auth::user()->id])}}" class="edit-profile__form" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="edit-profile__form-row">
                <label for="image" class="edit-profile__label">Photo
                </label>
                <input 
                    id="name"
                    type="file"    
                    class="edit-profile__input"
                    name="image"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="username" class="edit-profile__label">
                    Username
                </label>
                <input 
                    type="text"
                    id="username"
                    class="edit-profile__input"
                    name="username"
                    value="{{$profile->username}}"
                   
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="website" class="edit-profile__label">
                    Website
                </label>
                <input
                    type="url"
                    id="website"
                    class="edit-profile__input"
                    value="{{$profile->website}}"
                    name="website"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="bio" class="edit-profile__label">
                    Bio
                </label>
                <textarea id="bio" class="edit-profile__textarea"    value="{{$profile->bio}}"
                    name="bio">{{$profile->bio}}</textarea>
            </div>
            <div class="edit-profile__form-row">
                <label for="email" class="edit-profile__label">
                    Email
                </label>
                <input 
                    type="email"
                    class="edit-profile__input"
                    id="email"
                    value={{Auth::user()->email}}
                    name="email"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="phone-number" class="edit-profile__label">
                    Phone Number
                </label>
                <input 
                    type="text"
                    class="edit-profile__input"
                    id="phone-number"
                    value="{{$profile->phone}}"
                    name="phone"
                />
            </div>
            <div class="edit-profile__form-row">
                <label for="gender" class="edit-profile__label">Gender</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="whatever">Whatever</option>
                </select>
            </div>
            <div class="edit-profile__form-row">
                <span class="edit-profile__label">Similar Account Suggestions</span>
                <input type="checkbox" id="similar" checked>
                <label for="similar">Include your account when recommending similar accounts people might want to follow. <a href="#">[?]</a></label>
            </div>
            <div class="edit-profile__form-row">
                <label class="edit-profile__label"></label>
                <input type="submit" value="Submit">
            </div>
        </form>
    </section>
</main>

@endsection