<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\mission;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missions=mission::join('users','users.id','=','users_id')->select('missions.id as id', 'Fname','Lname','ville_retour','ville_depart','date_depart','date_retour','motif','total_mission','status')->get();
        return view('backend.missions.index',compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view('backend.missions.create',compact('users'));
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

        if(isset($request->user)&&!empty($request->user)&&isset($request->date_retour)&&!empty($request->date_retour)&&isset($request->motif)&&!empty($request->motif)&&isset($request->frais)&&!empty($request->frais)&&isset($request->ville_retour)&&!empty($request->ville_retour)&&isset($request->date_depart)&&!empty($request->date_depart)){

        if ($request->date_retour > $request->date_depart) {
            

         $missions= new mission();
         $missions->users_id = $request->user;
         $missions->date_depart = $request->date_depart;
         $missions->date_retour = $request->date_retour;
         $missions->ville_retour = $request->ville_retour;
         $missions->ville_depart = $request->ville_depart;
         $missions->motif = $request->motif;
         $missions->total_mission = $request->frais;
         $missions->status = 0;
         $missions->save();
         session()->flash('success', 'Enregistrement a reussit avec success');
         return redirect()->route('missions.index');

        }else{

           session()->flash('error', 'la date de retour doit etre superieur a celle de depart');
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
        
        $missions=mission::join('users','users.id','=','users_id')->where('missions.id',$id)->select('missions.id as id', 'Fname','Lname','ville_retour','ville_depart','date_depart','date_retour','motif','total_mission')->get();
        return view('backend.missions.show',compact('missions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::all();
        $missions=mission::find($id);
        return view('backend.missions.edit',compact('missions','users'));
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
    if(isset($request->user)&&!empty($request->user)&&isset($request->date_retour)&&!empty($request->date_retour)&&isset($request->motif)&&!empty($request->motif)&&isset($request->frais)&&!empty($request->frais)&&isset($request->ville_retour)&&!empty($request->ville_retour)&&isset($request->date_depart)&&!empty($request->date_depart)){

        if ($request->date_retour > $request->date_depart) {
            
         $missions= mission::find($id);
         $missions->users_id = $request->user;
         $missions->date_depart = $request->date_depart;
         $missions->date_retour = $request->date_retour;
         $missions->ville_retour = $request->ville_retour;
         $missions->ville_depart = $request->ville_depart;
         $missions->motif = $request->motif;
         $missions->total_mission = $request->frais;
         $missions->status = $request->status;
         $missions->save();
         session()->flash('success', 'Modification a reussit avec success');
         return redirect()->route('missions.index');

        }else{

           session()->flash('error', 'la date de retour doit etre superieur a celle de depart');
            return redirect()->back();

        }
            
        }else{

            session()->flash('error', 'veuillez remplir tous les champs');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id){
        $missions= mission::find($id);
        $missions->delete();
        session()->flash('success', 'Suppression a reussit avec success');
        return redirect()->route('missions.index');
    }
}
