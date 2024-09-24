<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\bulletins; 
use App\Models\fiscale; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Fname',
        'Lname',
        'sexe',
        'email',
        'password',
        'phone',
        'adresse',
        'poste_id',
        'identifiant',
        'date_contrat',
        'sm',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function insert($id,$user,$montant)
    {
        $mois=date('m');
        $count=bulletins::where('user_id',$user)->WhereMonth('created_at',$mois)->count();
        if ($count==1) {   
            //$update=bulletins::find($id);
            //$update->salaire = $montant;
           // $update->update();
        }
    }

    public static function insertfiscale($id,$montant,$mont)
    {
        $mois=date('m');
        $count=fiscale::where('user_id',$id)->WhereMonth('created_at',$mois)->count();

        if($count==0){

          $fiscales= new fiscale();
          $fiscales->user_id = $id;
          $fiscales->montant_fiscale = $montant;
          $fiscales->montant_cnps = $mont;
          $fiscales->save();
      }

  }
}
