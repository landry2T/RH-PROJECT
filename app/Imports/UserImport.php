<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClasseImport implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {

        $mot='user';
        for ($i=0; $i<3; $i++) { 
          $mot.=mt_rand(0,9); 
        }

        $users = User::where('phone', $row['telephone'])->orWhere('email', $row['email'])->first();
            if($users){

                $user->update([
                    'Fname' => $row['nom'],
                    'Lname' => $row['prenom'],
                    'sexe' => $row['sexe'],
                    'email' => $row['email'],
                    'phone' => $row['telephone'],
                    'adresse' => $row['adresse'],
                    'date_contrat' => $row['debut_contrat'],
                    'sm' => $row['situation_matrimoniale'],
                    'poste_id' => 1,
                    'password' => Hash::make($mot),
                    'identifiant' => $mot,
                ]);

            }else{

                User::create([
                    'Fname' => $row['nom'],
                    'Lname' => $row['prenom'],
                    'sexe' => $row['sexe'],
                    'email' => $row['email'],
                    'phone' => $row['telephone'],
                    'adresse' => $row['adresse'],
                    'date_contrat' => $row['debut_contrat'],
                    'sm' => $row['situation_matrimoniale'],
                    'poste_id' => 1,
                    'password' => Hash::make($mot),
                    'identifiant' => $mot,
                ]);
            }

        }
    }
}

