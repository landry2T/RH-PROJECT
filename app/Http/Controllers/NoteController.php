<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\notes;
use App\Models\Admin;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notes=notes::all();
        return view('backend.notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.notes.create');
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
        'sujet' => 'required',
        'contenu' => 'required|max:255',
        ]);

        if(isset($request->sujet)&&!empty($request->sujet)&&isset($request->contenu)&&!empty($request->contenu)){
        $notes= new notes();
        $notes->subject= $request->sujet;
        $notes->contenu = $request->contenu;
        $notes->save();
        session()->flash('success', 'Enregistrement reussit avec success');
        return redirect()->route('notes.index'); 
        }else{
         session()->flash('error', 'veuillez remplir tous les champs');
         return redirect()->route('notes.create');   
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
        $notes = notes::find($id);
        $admin=Admin::find(1);
        return view('backend.notes.edit',compact('notes','admin'));

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
            $notes = notes::find($id);
            $notes->subject= $request->sujet;
            $notes->contenu= $request->contenu;
            $notes->update();
            session()->flash('success', 'Modification a reussit avec success');
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
        //
      $notes=notes::find($id);
      $notes->delete();
      session()->flash('success', 'Suppression a reussit avec success');
      return redirect()->back();
    }
}
