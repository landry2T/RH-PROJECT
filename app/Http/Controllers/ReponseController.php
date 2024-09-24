<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Reponses;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions=Questions::all();
        $reponses=Reponses::join("questions","questions.id","=","qes_id")->select('reponses.id as id','name_question','valeur_reponse','reponses.created_at as create')->get();
        return view('backend.reponses.index',compact('reponses','questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $questions=Questions::all();
         return view('backend.reponses.create' , compact('questions'));
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
        if(isset($request->name)&&!empty($request->name)&&isset($request->qes_id)&&!empty($request->qes_id)){

        $count= Reponses::where('qes_id',$request->qes_id)->where('valeur_reponse',$request->name)->count();

        if($count==0){
         
         $reponses= new Reponses();
         $reponses->qes_id = $request->qes_id;
         $reponses->valeur_reponse = $request->name;
         $reponses->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('reponses.index');   

           
        }else{

            session()->flash('error', 'La réponse a cette question existe déja');
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
        $reponses = Reponses::find($id);
        $reponses->qes_id = $request->qes_id;
        $reponses->valeur_reponse = $request->valeur;
        $reponses->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('reponses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reponses = Reponses::find($id);
        $reponses->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->route('reponses.index'); 
    }
}
