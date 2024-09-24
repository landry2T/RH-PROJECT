<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\bulletins;
use Session;

class DeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.declarations.index');
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
        $mois=$request->mois;
        $m=date('m');
        if ($mois < $m) {

        Session::put('mois', $mois);
        $admins=Admin::find(1);
        $users=bulletins::join('users','users.id','=','bulletins.user_id')->join('postes','postes.id','=','users.poste_id')->join('classifications','classifications.id','=','postes.class_id')->select('users.id as id','Lname','Fname','name_poste','nombre_heure','montant_heure','postes.id as idposte','date_contrat','numero_cnps')->get();
        
        return view('backend.declarations.create',compact('admins','users'));

       }else{

         session()->flash('error', 'cette declarations n"est pas encore disponible');
         return redirect()->route('declarations.index'); 
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
