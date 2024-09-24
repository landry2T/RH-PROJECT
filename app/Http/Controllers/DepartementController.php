<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departements;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements=Departements::all();
        return view('backend.departements.index',compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.departements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(isset($request->name)&&!empty($request->name)){

        $count= Departements::where('name_departement',$request->name)->count();

        if($count==0){
         
         $departements= new Departements();
         $departements->name_departement = $request->name;
         $departements->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('departements.index');   

           
        }else{

            session()->flash('error', 'ce departement existe déja');
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
        //

        $departements = Departements::find($id);
        $departements->name_departement = $request->name;
        $departements->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('departements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $departements= Departements::find($id);
        $departements->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->route('departements.index');
    }
}
