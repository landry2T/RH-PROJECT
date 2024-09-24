<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\typedocs;

class TypeDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=typedocs::all();
        return view('backend.typedocs.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.typedocs.create');
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

        $count= typedocs::where('name_type',$request->name)->count();

        if($count==0){
         
         $types = new typedocs();
         $types->name_type = $request->name;
         $types->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('typedocs.index');   

           
        }else{

            session()->flash('error', 'cette catégorie existe déja');
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
        $types = typedocs::find($id);
        $types->name_type = $request->name;
        $types->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('typedocs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $types= typedocs::find($id);
        $types->delete();
        session()->flash('success', 'Suppression a reussit');
        return redirect()->route('typedocs.index');
    }
}
