<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classifications;
use App\Imports\ClasseImport;
use Maatwebsite\Excel\Facades\Excel;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifications=Classifications::all();
        return view('backend.classifications.index',compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(isset($request->heure)&&!empty($request->heure)&&isset($request->montant)&&!empty($request->montant)){

        $count= classifications::where('name_categorie',$request->cat)->where('echellon',$request->echellon)->where('nombre_heure',$request->heure)->where('montant_heure',$request->montant)->count();

        if($count==0){
         
         $classifications= new Classifications();
         $classifications->name_categorie = $request->cat;
         $classifications->echellon = $request->echellon;
         $classifications->montant_heure = $request->montant;
         $classifications->nombre_heure = $request->heure;
         $classifications->profil = $request->profil;
         $classifications->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('classifications.index');   

           
        }else{

            session()->flash('error', 'cette classifications existe déja');
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

    public function importExcelData(Request $request){

        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new ClasseImport, $request->file('import_file'));
        return redirect()->back()->with('success', 'Importation a reussit');
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
        $classifications = Classifications::find($id);
        $classifications->name_categorie = $request->cat;
        $classifications->echellon = $request->echellon;
        $classifications->profil = $request->profil;
        $classifications->nombre_heure = $request->heure;
        $classifications->montant_heure = $request->montant;
        $classifications->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('classifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $classifications= classifications::find($id);
        $classifications->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->route('classifications.index');
    }
}
