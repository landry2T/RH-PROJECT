<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classifications extends Model
{
    use HasFactory;

     protected $table = 'classifications';

    protected $fillable = [
        'name_categorie',
        'echellon',
        'profil',
        'nombre_heure',
        'montant_heure',

    ];
}
