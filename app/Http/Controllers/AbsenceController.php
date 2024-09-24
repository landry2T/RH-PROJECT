<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Admin;

use App\Models\absences;

use Auth;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
      $absences = absences::join('users','users.id','=','user_id')->select('absences.id as id','Fname','Lname','date_debut','date_fin','motif','autorisant','status')->get();
      return view('backend.absences.index',compact('absences','users'));
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('backend.absences.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(isset($request->user)&&!empty($request->user)&&isset($request->date_retour)&&!empty($request->date_retour)&&isset($request->motif)&&!empty($request->motif)){

           $count= absences::where('user_id',$request->user)->where('motif',$request->motif)->where('date_debut',$request->date_depart)->where('date_fin',$request->date_retour)->count();

           if($request->date_retour > $request->date_depart){
               if($count==0){

                $absences = new absences();
                $absences->user_id = $request->user;
                $absences->date_debut=$request->date_depart;
                $absences->date_fin=$request->date_retour;
                $absences->autorisant=$request->autorisant;
                $absences->motif=$request->motif;
                $absences->save();
                session()->flash('success', 'Enregistrement a reussit avec success');
                return redirect()->route('absences.index');

            }else{
                session()->flash('error', 'cet absence a déja été pris en compte');
                return redirect()->back();
            }

        }else{

            session()->flash('error', 'la date de retour dois superieur a celle de depart');
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
    public function edited(Request $request, $id)
    {

        $absences = absences::where('id',$id)->update(['status'=>$request->val]);
        session()->flash('success', 'Mis a jour du status a reussit avec success');
        return redirect()->route('absences.index');
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
        $absences = absences::find($id);
        $absences->user_id = $request->user;
        $absences->date_debut=$request->date_depart;
        $absences->date_fin=$request->date_retour;
        $absences->motif=$request->motif;
        $absences->update();
        session()->flash('success', 'Modification a reussit avec success');
        return redirect()->route('absences.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $absences=absences::find($id);
      $absences->delete();
      session()->flash('success', 'Suppression a reussit avec success');
      return redirect()->back();


  }

  public function getabsence()
  {
     $id=Auth::user()->id;
     $absences=absences::where('user_id',$id)->get();
     return view('frontend.dashboard.absence', compact("absences")); 
 }

 public function createabsence()
 {
  return view('frontend.dashboard.absence_create');  
}

public function postabsence(Request $request)
{

 if(isset($request->date_retour)&&!empty($request->date_retour)&&isset($request->motif)&&!empty($request->motif)){

   if($request->date_retour > $request->date_depart){

    $absences = new absences();
    $absences->user_id = Auth::user()->id;
    $absences->date_debut=$request->date_depart;
    $absences->date_fin=$request->date_retour;
    $absences->autorisant=$request->autorisant;
    $absences->motif=$request->motif;
    $absences->save();
    session()->flash('success', 'Enregistrement a reussit avec success');
    return redirect()->route('absence');

}else{

    session()->flash('error', 'la date de retour dois superieur a celle de depart');
    return redirect()->back();
}}else{ 

    session()->flash('error', 'veuillez remplir tous les champs');
    return redirect()->back();
}

}

public function deleteabsence($id)
{
    $absences=absences::find($id);
    $absences->delete();
    session()->flash('success', 'Suppression a reussit avec success');
    return redirect()->route('absence');
}

public function printing($id)
{
    $admin=Admin::find(1);
    $users=absences::join('users','users.id','=','absences.user_id')->join('postes','postes.id','=','users.poste_id')->where('absences.id',$id)->get();
   return view('backend.absences.print',compact('admin','users'));
}

public function updateabsence(Request $request , $id)
{
  $absences = absences::find($id);
  $absences->date_debut=$request->date_depart;
  $absences->date_fin=$request->date_retour;
  $absences->autorisant=$request->autorisant;
  $absences->motif=$request->motif;
  $absences->update();
  session()->flash('success', 'Modification a reussit avec success');
  return redirect()->route('absence');
}

}
