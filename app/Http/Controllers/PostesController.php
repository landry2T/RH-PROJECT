<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classifications;
use App\Models\Departements;
use App\Models\Postes;

class PostesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $departements=Departements::all();
        $classifications=Classifications::all();
        $postes=Postes::join('classifications','classifications.id','=','class_id')->join('departements','departements.id','=','dep_id')->select("postes.id as id","name_poste",'class_id','dep_id','nombre_heure','montant_heure','name_categorie','echellon','name_departement')->get();
        return view('backend.postes.index',compact('departements','classifications','postes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements=Departements::all();
        $classifications=Classifications::all();
        return view('backend.postes.create',compact('departements','classifications'));
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

        if(isset($request->class)&&!empty($request->class)&&isset($request->dep)&&!empty($request->dep)&&isset($request->name)&&!empty($request->name)){

        $count= Postes::where('class_id',$request->class)->where('dep_id',$request->dep)->where('name_poste',$request->name)->count();

        if($count==0){
         
         $postes= new Postes();
         $postes->class_id = $request->class;
         $postes->dep_id = $request->dep;
         $postes->name_poste = $request->name;
         $postes->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('postes.index');   

           
        }else{

            session()->flash('error', 'ce poste existe déja');
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
        $postes = Postes::find($id);
        $postes->class_id = $request->class;
        $postes->dep_id = $request->dep;
        $postes->name_poste = $request->name;
        $postes->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('postes.index');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postes= Postes::find($id);
        $postes->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->route('postes.index');
    }
}
