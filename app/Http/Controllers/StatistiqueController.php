<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\bulletins;
use App\Models\avances;
use App\Models\heures;
use App\Models\absences;
use App\Models\mission;
use DB;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users=User::all();
       return view('backend.statistiques.index',compact('users'));
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

    public function getsearch(Request $request){
        
        $id=$request->id;

        $paies = bulletins::join('users','users.id','=','user_id')->where('user_id', $id)->select('Fname','Lname','users.id as id','bulletins.id as idbul')->get();

        $avances = avances::where('users_id',$id)->get();

        $heures = heures::where('users_id',$id)->get();

        $absences = absences::where('user_id',$id)->get();

        $users = User::all();
        
        $final=DB::select("select sum(savoir_etre + savoir_faire) as etre  , mois from notations where users_id ='".$id."'  group by mois");
        
        $listmois=array();
        $notes=array();
        $newmonth=array();
        
         $lesMois = array(
                   '1' => 'janvier',
                   '2' => 'fevrier',
                   '3' => 'mars',
                   '4' => 'avril',
                   '5' => 'mai',
                   '6' => 'juin',
                   '7' => 'juillet',
                   '8' => 'aout',
                   '9' => 'septembre',
                   '10' => 'octobre',
                   '11' => 'novembre',
                   '12' => 'decembre'
           );
           
    for ($i=0; $i < count($final); $i++) { 

        $notes[] = $final[$i]->etre;
        $listmois[] = $final[$i]->mois;
        $id=$listmois[$i];
        $newmonth[]=$lesMois[$id];
     }

        $missions = mission::join('users','users.id','=','users_id')->where('users_id', $id)->select('Fname','Lname','motif','date_depart','date_retour','missions.id as id')->get();

        $view= (String) view('backend.statistiques.index',compact('avances','paies','users','heures','absences','missions','notes','newmonth'));

        return response($view);
    }
}
