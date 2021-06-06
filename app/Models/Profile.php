<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // gašenje out-of-package mass assignment funkcionalnosti, koje sam podesio unutar profilescontrollera
    protected $guarded = [];

    public function profileImage(){
       $imagePath = ($this->image) ?  $this->image : 'profile/9ru0AnNhzRigGNFmtHr17GyBBq2sm1MNmlbJOQE3.png'; 
       return '/storage/' . $imagePath;
    }

    // Profili mogu imati više pratioca - zato je ovako postavljeno - pogledaj User method
    public function followers(){
        return $this->belongsToMany(User::class);
        }

    // ovo je funkcija kojom povezujem profile s userima
    public function user(){
        return $this->belongsTo(User::class);
    }

}
