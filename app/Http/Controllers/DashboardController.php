<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\conges;

use App\Models\config_conges;

use App\Models\Postes;

use App\Models\Departements;

use App\Models\bulletins;

use App\Models\absences;

use App\Models\mission;

use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     $users= count(User::all());
     $postes= count(Postes::all());
     $departements= count(Departements::all());
     $bulletins=count(bulletins::all());
     $absences = absences::where('status',0)->count();
     $missions = mission::where('status',0)->count();
     $conges = DB::table('config_conges')->where('status',0)->count();    
     $stat=DB::select('select sum(salaire) as sal , profil from bulletins , classifications,users,postes where users.id=bulletins.user_id and classifications.id=postes.class_id and postes.id=users.poste_id group by profil');

    $grap_charges = DB::select("select sum(montant_fiscale) as charges, sum(montant_cnps) as chargesp , month(created_at) as mois from fiscales group by mois");
 

    $charges=array();
    $chargesp=array();
    $month=array();
    $newmonth=array();
    $lesMois = array(
                   '1' => 'janvier',
                   '2' => 'fevrier',
                   '3' => 'mars',
                   '4' => 'avril',
                   '5' => 'mai',
                   '6' => 'juin',
                   '7' => 'juillet',
                   '8' => 'août',
                   '9' => 'septembre',
                   '10' => 'octobre',
                   '11' => 'novembre',
                   '12' => 'décembre'
           );


    for ($i=0; $i < count($grap_charges); $i++) { 

        $charges[] = $grap_charges[$i]->charges;
        $chargesp[] = $grap_charges[$i]->chargesp;
        $month[] = $grap_charges[$i]->mois;
        $id=$month[$i];
        $newmonth[]=$lesMois[$id];
     }

     $profil=array();
     $salaire=array();

     for ($i=0; $i <count($stat); $i++) { 
         
         $profil[] = $stat[$i]->profil;
         $salaire[] = $stat[$i]->sal;
     }
      
    
    return view('backend.dashboard.index',compact('users','postes','departements','bulletins','absences','conges','profil','salaire','charges','chargesp','newmonth','missions'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
