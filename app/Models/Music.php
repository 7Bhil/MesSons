<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    //
    protected $fillable= [
        'nom',
        'fichier',
        'couverture',
        'auteur',
    ];
}
