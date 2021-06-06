@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" alt="" class="w-100">
        </div>
        <div class="col-3">
            <div class="row align-items-center">
                <div class="col-3">
                    <img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle w-100">
                </div>
                <div class="col-5">
                        <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                </div>
                <div class="col-4">
                    <a href="#" class="ml-2">Follow</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <span class="font-weight-bold mr-3"> 
                        <a href="/profile/{{ $post->user->profile->id }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>
                    <span>{{ $post->caption }}</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
