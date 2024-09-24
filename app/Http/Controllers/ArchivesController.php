<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\archives;
use App\Models\typedocs;

use DB;

class ArchivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives = archives::join('typedocs','typedocs.id','=','type_id')->select('archives.id as id','name_doc','name_type','name_file','description_doc')->get();
        $types = typedocs::all();
        return view('backend.archives.index',compact('archives','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = typedocs::all();
        return view('backend.archives.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              
        $request->validate([
            'namedoc' => 'required',
            'categorie' => 'required|int',
            'fichier'=> 'file|required',
        ]);


        $i=$request->fichier;

        if ($request->hasFile('fichier')&&($i->getClientOriginalExtension()=='pdf'|| $i->getClientOriginalExtension()=='txt')||$i->getClientOriginalExtension()=='docx') {


            $image=$request->file('fichier'); 
            $img=$image->getClientOriginalName();

            $count=DB::table('archives')->where('name_doc', $request->namedoc)->count();

            if ($count==0) {
                $destination='uploads';
                $image->move($destination,$img);

               //Create New documents
                $archives = new archives();                 
                $archives->name_doc = $request->namedoc;
                $archives->type_id = $request->categorie;
                $archives->name_file = $img;
                $archives->description_doc = $request->description;
                $archives->save();
                session()->flash('success', 'Enregistrement a reussit avec success !!');
                return redirect()->route('archives.index'); 

             }else{

                session()->flash('error', 'le fichier exixte déja dans notre base de donnée');
                return back();

            }

        }else{

         session()->flash('error', 'le fichier renseigné de type PDF , WORD ou TXT');
         return back();   
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
        $archives = archives::find($id);
        if (!is_null($archives)) {
            $archives->delete();
        }
        session()->flash('success', 'suppression reussit avec success !!');
        return back();
    }
}
