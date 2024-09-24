<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\notations;

class NotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $evaluations = notations::join('users','users.id','=','users_id')->select('notations.id as id', 'savoir_etre','savoir_faire','mois','users_id','Fname','Lname','savoir_faire','savoir_etre')->get();
        $users = User::all();
        return view('backend.evaluations.index',compact('evaluations','users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.evaluations.create',compact('users')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

     if(isset($request->user_id)&&!empty($request->user_id)){

        $count= notations::where('users_id',$request->user_id)->where('mois',$request->mois)->count();

           if($count==0){

            $evals = new notations();
            $evals->users_id = $request->user_id;
            $evals->mois=$request->mois;
            $evals->savoir_etre=$request->savoir_etre;
            $evals->savoir_faire=$request->savoir_faire;
            $evals->save();
            session()->flash('success', 'Enregistrement reussi avec success');
            return redirect()->route('evaluations.index');

        }else{
            session()->flash('error', 'ce salarié a été déja  évaluer ce mois');
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
        $evals = notations::find($id);
        $evals->users_id = $request->user_id;
        $evals->mois = $request->mois;
        $evals->savoir_etre = $request->etre;
        $evals->savoir_faire = $request->faire;
        $evals->update();
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
        $evals = notations::find($id);
        $evals->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->back();
    }
}
