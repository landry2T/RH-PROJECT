<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Primes;

class PrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primes= Primes::all();
        return view('backend.primes.index',compact('primes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.primes.create');
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

           $count= Primes::where('nature_prime',$request->nature)->where('libelle_prime',$request->name)->count();
           if($count==0){

            $primes= new Primes();
            $primes->nature_prime=$request->nature;
            $primes->libelle_prime=$request->name;
            $primes->taux_prime=$request->taux;
            $primes->save();
            session()->flash('success', 'Enregistrement a reussit avec success');
            return redirect()->route('primes.index');

           }else{
            session()->flash('error', 'cette prime existe déja');
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
     $primes = Primes::find($id);
     $primes->nature_prime=$request->nature;
     $primes->libelle_prime=$request->name;
     $primes->taux_prime=$request->taux;
     $primes->update();
     session()->flash('success', 'Modification a reussit avec success');
     return redirect()->route('primes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)   
    {
       $primes = Primes::find($id);
       $primes->delete();
       session()->flash('success', 'supression a reussit success');
       return redirect()->back();
    }


    public function getnature(Request $request)
    {
        $id=$request->id;

        if($id=="taxable et cotisable"){

            $reponse = " <label>Taux prime:*</label><input type='number' name='taux' class='form-control' min=0><br>";

        }elseif($id=="taxable et pas cotisable"){
          
            $reponse=" <label>Taux prime:*</label><input type='number' name='taux' class='form-control' min=0><br>";

        }else{

            $reponse="";
        }

        return response($reponse);
    }
}
