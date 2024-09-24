<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\heures;
use App\Models\User;
use DB;

class HeureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all();
        $heures=heures::join('users','users.id','=','users_id')->select('Fname','Lname','nbre_heure','montant_heure','heures.created_at as create','mois','heures.id as id')->get();
        return view('backend.heures.index',compact('heures','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users=User::all();
        return view('backend.heures.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'user_id' => 'required',
        'mois' => 'required|max:255',
        'nbre' => 'required|int',
        'montant' => 'required',
        ]);

        $mois=date('m');

        if ($mois<=$request->mois ) {

        $count= heures::where('users_id',$request->user_id)->where('mois',)->count();

         if($count==0){

            $heures = new heures();
            $heures->users_id= $request->user_id;
            $heures->mois= $request->mois;
            $heures->nbre_heure= $request->nbre;
            $heures->montant_heure= $request->montant;
            $heures->save();
            session()->flash('success', 'Enregistrement reussit avec succes');
            return redirect()->route('heures.index');

         }else{

            session()->flash('error', 'ce salarié a déja des heures supplementaires pour ce mois');
            return redirect()->route('heures.create');
         }

     }else{

        session()->flash('error', 'Vous ne pouvez pas enregistré une heure supplementaire a un mois anterieur');
        return redirect()->route('heures.create');
     }

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
            $heures = heures::find($id);
            $heures->users_id= $request->user_id;
            $heures->mois= $request->mois;
            $heures->nbre_heure= $request->nbre;
            $heures->montant_heure= $request->montant;
            $heures->update();
            session()->flash('success', 'Mise a jour reussit avec success');
            return redirect()->route('heures.index');
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
      $heures=heures::find($id);
      $heures->delete();
      session()->flash('success', 'Suppression a reussit avec success');
      return redirect()->back();
    }
}
