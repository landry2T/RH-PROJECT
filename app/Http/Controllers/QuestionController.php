<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Questions;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        $questions=Questions::join("categories","categories.id","=","cat_id")->select('questions.id as id','cat_id','name','name_question','questions.created_at as create')->get();
        return view('backend.questions.index',compact('questions','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::all();
        return view('backend.questions.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(isset($request->name)&&!empty($request->name)&&isset($request->cat_id)&&!empty($request->cat_id)){

        $count= Questions::where('name_question',$request->name)->where('cat_id',$request->cat_id)->count();

        if($count==0){
         
         $questions= new Questions();
         $questions->name_question = $request->name;
         $questions->cat_id = $request->cat_id;
         $questions->save();
         session()->flash('success', 'Insertion a reussit');
         return redirect()->route('questions.index');   

           
        }else{

            session()->flash('error', 'cette questions existe déja');
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
        $questions = Questions::find($id);
        $questions->name_question = $request->name;
        $questions->cat_id = $request->cat_id;
        $questions->update();
        session()->flash('success', 'Modification a reussit');
        return redirect()->route('questions.index');
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
        $questions = Questions::find($id);
        $questions->delete();
        session()->flash('success', 'Suppression     a reussit');
        return redirect()->route('questions.index');  
    }
}
