<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use \App\Mail\WelcomeEmail;



class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username,
            ]);

            Mail::to($user->email)->send(new WelcomeEmail());

        });
    }

    // ovo je funkcija kojoj govorim laravelu da jedan user može imati više postova putem hasMany i povezujem
    // te podatke na laravelovom levelu
    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    // useri mogu pratiti više profila - pogledaj Profile method
    public function following(){
        return $this->belongsToMany(Profile::class);
    }



    // ovo je funkcija kojom se obezbjeđuje da profili i useri idu u dva smjera  - hasOne i tamo belongsTo
    // nisam pisao lokalni url do Profile - App/Models/Profile, jer je već pozvano u vrhu fajla
    public function profile(){
        return $this->hasOne(Profile::class);
    }

}
