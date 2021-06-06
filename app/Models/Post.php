<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // gasim laravelov feature kojim blokira nezaštićena polja unutar uploada podataka, a pošto sam koristio
    // imenovanje svih polja unutar posts controllera, smijem ugasiti ovu opciju.
    protected $guarded = [];

    // ovo je funkcija kojom inverzujem funkciju iz user.php i kojoj govorim da post pripada useru
    public function user(){
        return $this->belongsTo(User::class);
    }

}
