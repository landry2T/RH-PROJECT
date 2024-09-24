<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Primes;

use App\Models\Postes;

use App\Models\config_primes;

class Config_primesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes=Postes::all();
        $primes=Primes::all();
        $configs = config_primes::join('primes','primes.id','=','prime_id')->join('postes','postes.id','=','poste_id')->select('config_primes.id as id','libelle_prime','name_poste','montant_prime')->get();
        return view('backend.config_primes.index',compact('primes','postes','configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postes=Postes::all();
        $primes=Primes::all();
        return view('backend.config_primes.create',compact('primes','postes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          if(isset($request->montant)&&!empty($request->montant)&&isset($request->poste)&&!empty($request->poste)&&isset($request->prime)&&!empty($request->prime)){

           $count= config_primes::where('poste_id',$request->poste)->where('prime_id',$request->prime)->count();
           if($count==0){

            $configs = new config_primes();
            $configs->prime_id=$request->prime;
            $configs->poste_id=$request->poste;
            $configs->montant_prime=$request->montant;
            $configs->save();
            session()->flash('success', 'insertion a reussit');
            return redirect()->route('config_primes.index');

           }else{
            session()->flash('error', 'cette configuration de prime existe déja');
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
     $configs = config_primes::find($id);
     $configs->prime_id=$request->prime;
     $configs->poste_id=$request->poste;
     $configs->montant_prime=$request->montant;
     $configs->update();
     session()->flash('success', 'Modification a reussit');
     return redirect()->route('config_primes.index');
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
