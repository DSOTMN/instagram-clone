@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle ml-5" style="max-height: 130px;">
        </div>
        <div class="col-9 p-4">
            <div class="d-flex flex-row align-items-center mb-3">
                <div class="d-flex align-items-center">
                    
                    <div class="h3">{{ $user->username }}</div>
                        
                    <follow-unfollow user-id="{{ $user->id }}"  follows={{ $follows }}></follow-unfollow>                  
                
                </div>
                
                @can('update', $user->profile)
                        <a href="/p/create">Add new post</a>
                @endcan

                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit your profile</a>  
                @endcan


            </div>

            <div class="row">
                <div class="col-2"><strong> {{ $postCount }} </strong> posts</div>
                <div class="col-2"><strong> {{ $followerCount }} </strong> followers</div>
                <div class="col-2"><strong> {{ $followingCount }} </strong> following</div>
            </div>
            <div class="row">
                <div class="col-3 mt-3"><strong>{{ $user->profile->title }}</strong></div>
            </div>
            <div class="row">
                <div class="col-6">{{ $user->profile->description }}</div>
            </div>
            <div class="row">
                <div class="col-4">
                    <a href="https://instagram.com/hadzic_aladin">{{ $user->profile->url }}</a>
                </div>                
            </div>
        </div>
    </div>
    <div class="row mt-5">
        @foreach($user->posts as $post) 
            <div class="col-4 mb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" alt="" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
