<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Classifications;

class ClasseImport implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $classes = Classifications::where('echellon', $row['echellon'])->where('name_categorie', $row['categorie'])->first();
            if($classes){

                $classes->update([
                    'name_categorie' => $row['categorie'],
                    'echellon' => $row['echellon'],
                    'profil' => $row['type_profil'],
                    'nombre_heure' => $row['nombre_heure_mensuel'],
                    'montant_heure' => $row['montant_heure_mensuel'],
                ]);

            }else{

                Classifications::create([
                    'name_categorie' => $row['categorie'],
                    'echellon' => $row['echellon'],
                    'profil' => $row['type_profil'],
                    'nombre_heure' => $row['nombre_heure_mensuel'],
                    'montant_heure' => $row['montant_heure_mensuel'],
                ]);
            }

        }
    }
}
