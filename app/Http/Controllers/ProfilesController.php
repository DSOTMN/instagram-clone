<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// pošto ću koristiti Laravel cache
use Illuminate\Support\Facades\Cache;

use Intervention\Image\Facades\Image;

// ovo sam ja importovao kako bih koristio User Model unutar controllera ( .php nije potrebno pisati )
use App\Models\User;

class ProfilesController extends Controller
{
    public function index(User $user)
    {

        // check if authenticated user following contains user from above parameter
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // vidi kako pozivam iz profiles foldera specifičan view za prikaz profila - index


        // ovdje ako ne koristim use($user), dobijem undefined variable $user 

        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function() use($user) {
            return $user->posts->count();
        } );

        $followerCount = Cache::remember('count.followers.' . $user->id, now()->addSeconds(30), 
        function() use($user){
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember('count.following' . $user->id, now()->addSeconds(30),
        function() use($user){
            return $user->following->count();
        });
        
        return view('profiles.index', compact('user', 'follows', 'postCount', 'followerCount', 'followingCount'));
    }

    public function edit(User $user){
        // ova linija koda mi iz nekog razloga blokira pristup editingu profila - izgleda sad radi pravilno
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        // ovo imageArray ?? [] - ako nije zadana nova slika unutar update profila, array je prazan i ne briše se postojeća,
        // nego se koristi trenutna slika ili default postavljena iz Profile modela.

        return redirect("/profile/{$user->id}");
    }
}
