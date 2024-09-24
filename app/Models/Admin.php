<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'adresse',
        'logo',
        'niveau_risque',
        'numero_cnps',
        'slogan',
        'secteur',
        'urlsiteweb',
        'contribuable',
        'password',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}