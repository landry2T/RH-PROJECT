<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\conges;

use Auth;
use DB;

class CongesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $conges = conges::all();
        return view('backend.conges.index',compact('conges'));   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.conges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(isset($request->name)&&!empty($request->name)&&isset($request->duree)&&!empty($request->duree)){

         $count= conges::where('libelle_conge',$request->name)->count();

         if($count==0){

            $conges = new conges();
            $conges->libelle_conge = $request->name;
            $conges->jour_conge=$request->duree;
            $conges->save();
            session()->flash('success', 'insertion a reussit');
            return redirect()->route('conges.index');

        }else{
            session()->flash('error', 'ce type de congé existe déja');
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
        $conges = conges::find($id);
        $conges->libelle_conge = $request->name;
        $conges->jour_conge=$request->duree;
        $conges->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conges = conges::find($id);
        $conges->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->back();
    }


    public function getconge()
    {
        $id=Auth::user()->id;
        $conges=DB::table('config_conges')->join('conges','conges.id','=',"type_id")->where('user_id',$id)->get();
        return view('frontend.dashboard.conge',compact('conges'));
    }

    public function getconges()
    {
        $conges = conges::all();
        return view('frontend.dashboard.addconge',compact('conges'));
    }

    public function postconge(Request $request){

     if(isset($request->conge)&&!empty($request->conge)&&isset($request->depart)&&!empty($request->depart)){

            $id=Auth::user()->id;

        $count= config_conges::where('user_id',$id)->where('type_id',$request->conge)->where('date_depart',$request->depart)->count();

           if($count==0){

            $conges= conges::find($request->conge);
            $duree = $conges->jour_conge;
            $retour = date('Y-m-d', strtotime('+'.$duree.'day', strtotime($request->depart)));
            $configs = new config_conges();
            $configs->user_id=$id;
            $configs->type_id=$request->conge;
            $configs->date_depart=$request->depart;
            $configs->date_retour=$retour;
            $configs->save();
            session()->flash('success', 'Enregistrement a reussit avec success');
            return redirect()->route('conge');

           }else{
            session()->flash('error', 'Vous avez deja demander un conge pour cette date');
            return redirect()->back();
           }

          }else{ 

            session()->flash('error', 'veuillez remplir tous les champs');
            return redirect()->back();
          
        }

    }



    public function destroyconge($id)
    {
        $configs = config_conges::find($id);
        $configs->delete();
        session()->flash('success', 'supression a reussit avec success');
        return redirect()->route('conge');
    }

}
