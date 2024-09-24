<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\avances;
use App\Models\User;
use DB;

class AvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $avances=avances::join('users','users.id','=','users_id')->select('Fname','Lname','montant_avance','avances.created_at as create','mois','avances.id as id')->get();
        $users=User::all();
        return view('backend.avances.index',compact('avances','users'));
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
        return view('backend.avances.create', compact('users'));
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
        $validated = $request->validate([
        'user_id' => 'required',
        'mois' => 'required|max:255',
        'montant' => 'required',
        ]);

        $count= avances::where('users_id',$request->user_id)->where('mois',$request->mois)->count();
        $mois=date('m');

        if($mois  <= $request->mois){

         if($count==0){

            $avances = new avances();
            $avances->users_id= $request->user_id;
            $avances->mois= $request->mois;
            $avances->montant_avance= $request->montant;
            $avances->save();
            session()->flash('success', 'Enregistrement reussit avec success');
            return redirect()->route('avances.index');

         }else{

            session()->flash('error', 'ce salarié a déja pris une avance salariale pour ce mois');
            return redirect()->route('avances.create');
         }
       }else{

            session()->flash('error', 'Vous ne pouvez pas enregistré une avance a un mois anterieur');
            return redirect()->route('avances.create');
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

        $mois=date('m');

        if ($mois<=$request->mois) {
            $avances = avances::find($id);
            $avances->users_id= $request->user_id;
            $avances->mois= $request->mois;
            $avances->montant_avance= $request->montant;
            $avances->update();
            session()->flash('success', 'Mise a jour reussit avec success');
            return redirect()->route('avances.index');
        }else{
         
            session()->flash('error', 'Vous ne pouvez pas enregistré une avance a un mois anterieur');
            return redirect()->route('avances.index');
        }

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $avances=avances::find($id);
      $avances->delete();
      session()->flash('success', 'Suppression a reussit avec success');
      return redirect()->back();
    }
}
