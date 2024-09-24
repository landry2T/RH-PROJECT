<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Primes;
use App\Models\heures;
use App\Models\avances;

class Declarations extends Model
{
    use HasFactory;

    public static function prime_impossable($id)
    {
        
      $imposable=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id', $id)->where('nature_prime','imposable')->get();
      return $imposable;
    }

    public static function prime_cotisable($id)
    {
        
        $cotisable=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$id)->where('nature_prime','taxable et pas cotisable')->get();
        return $cotisable;
    }

    public static function prime_cotisables($id)
    {
        $cotisabes=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$id)->where('nature_prime','taxable et cotisable')->get();

        return $cotisabes;
    }

    public static function indemnite($id)
    {
        $indemnites=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$id)->where('nature_prime','indemnité')->get();
        return $indemnites;
    }

    public static function conges($id)
    {
        $conges=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$id)->where('nature_prime','conge')->get();
        return $conges;
    }

    public static function heures($id_user , $mois)
    {
        $heures=heures::where('users_id',$id_user)->whereMonth('created_at',$mois)->get();
        return $heures;
    }

    public static function avances($id_user , $mois)
    {
        $avances=avances::where('users_id',$id_user)->whereMonth('created_at',$mois)->get();
        return $avances;
    }



}
