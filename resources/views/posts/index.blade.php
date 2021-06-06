@extends('layouts.app')

@section('content')

<div class="container">    
@foreach ($posts as $post)
    <div class="row mb-3">
        <div class="col-6 align-items-center">
            <div class="row align-items-center">
                <div class="col-3">
                    <a href="/profile/{{ $post->user->id }}">
                        <img src="{{ $post->user->profile->profileImage() }}" alt="" style="max-width: 30px;" class="rounded-circle w-100">
                    </a>
                </div>
                <div class="col-5">
                        <a href="/profile/{{ $post->user->profile->id }}" class="font-weight-bold">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                </div>
                    <a href="#" class="ml-2">Follow</a>
                <div class="col-4">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-7">
            <a href="/profile/{{ $post->user->id }}">
                <img src="/storage/{{ $post->image }}" alt="" class="w-100">
            </a>
        </div>
    </div>

    <div class="row mb-5 pt-2">
        <div class="col">
            <span class="font-weight-bold mr-3"> 
                <a href="/profile/{{ $post->user->profile->id }}">
                    <span class="text-dark">{{ $post->user->username }}</span>
                </a>
            </span>
            <span>{{ $post->caption }}</span>
        </div>
    </div>

@endforeach

<!-- uz korištenje paginate() iz postcontrollera, dobijam opciju korištenja links() koja linkuje do ostatka postova -->

    <div class="row">
        <div class="col-12 d-flex">
            <div class="col justify-content-center">{{ $posts->links() }}</div>
        </div>
    </div>

</div>
@endsection
