<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\conges;

use App\Models\config_conges;

class Config_congesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conges=conges::all();
        $users=User::all();
        $configs = config_conges::join('users','users.id','=','user_id')->join('conges','conges.id','=','type_id')->select('config_conges.id as id','Fname','Lname','date_depart','date_retour','status','libelle_conge')->get();
        return view('backend.config_conges.index',compact('conges','users','configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conges=conges::all();
        $users=User::all();
        return view('backend.config_conges.create',compact('conges','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->user)&&!empty($request->user)&&isset($request->conge)&&!empty($request->conge)&&isset($request->depart)&&!empty($request->depart)){

           $count= config_congés::where('user_id',$request->user)->where('type_id',$request->conge)->where('date_depart',$request->depart)->count();

           if($count==0){

            $conges= conges::find($request->conge);
            $duree = $conges->jour_conge;
            $retour = date('Y-m-d', strtotime('+'.$duree.'day', strtotime($request->depart)));
            $configs = new config_congés();
            $configs->user_id=$request->user;
            $configs->type_id=$request->conge;
            $configs->date_depart=$request->depart;
            $configs->date_retour=$retour;
            $configs->save();
            session()->flash('success', 'Enregistrement a reussit avec success');
            return redirect()->route('config_conges.index');

           }else{
            session()->flash('error', 'cet employé est déja en congé');
            return redirect()->back();
           }

          }else{ 

            session()->flash('error', 'veuillez remplir tous les champs');
            return redirect()->back();
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
            $configs = config_conges::find($id);
            $configs->user_id=$request->user;
            $configs->type_id=$request->conge;
            $configs->date_depart=$request->depart;
            $configs->date_retour=$request->retour;
            $configs->update();
            session()->flash('success', 'Modification a reussit avec success');
            return redirect()->route('config_conges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $configs = config_conges::find($id);
        $configs->delete();
        session()->flash('success', 'supression a reussit avec success');
        return redirect()->route('config_conges.index');
    }
}
