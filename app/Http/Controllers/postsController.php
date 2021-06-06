<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

use \App\Models\Post;

class postsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');

        // hvatam postove, kojima je user_id jednak id-jevima iz $users varijable. 
        //Metoda latest() mijenja cijelu metodu: orderBy('created_at', 'DESC').
        // na kraju mogu koristiti get() - prikazuje sve moguće postove na jednoj(početnoj) stranici
        // uz pomoć paginate() prikazujem samo zadani broj postova
        // with('user') označava loading user relationshipa - rješava limit-1 problem iz telescopa
        // to user se odnosi na user model
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create(){
        // ovo .create se može pisati i kao /create. ugl. to poziva fajl koji ima isto ime kao funkcija iznad
        // napravio sam poseban folder posts gdje ću staviti view-ove vezane za postove
        return view('posts.create');
    }

    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        //kraći način passinga podataka iz forme, nakon validacije putem $data, samo uvrstim $data unutar
        //argumenta i voila! a ako neki podatak ne zahtjeva validaciju gore iznad, onda ga mogu npr.
        // samo pozvati gore putem imena a sa desne strane ostaviit prazan prostor
        // auth zove autentificiranog korisnika i daje postovima user id, te se poziva create metoda
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
    
    public function show(\App\Models\Post $post){
        return view('posts.show', compact('post'));
    }


    /* OVO SAM DODAO PRIJE IZLASKA; TRAŽIM NAČIN DA POZIVAM UPDATE KONDICIONALNI - Za skrivanje/prikaz follow dugmeta na index page-u
    public function update(\App\Models\User $user){
        $this->authorize('update', $user->profile);
    }*/

}
