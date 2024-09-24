<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\Admin; 
use App\Models\Postes; 
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\UserMail;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=User::join('postes','postes.id','=','poste_id')->select('users.id as id','Fname','Lname','name_poste','date_contrat','phone')->get();
        return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mot='user';
        for ($i=0; $i<3; $i++) { 
          $mot.=mt_rand(0,9); 
        }
        $postes=Postes::all();
        return view('backend.users.create',compact("mot","postes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'fname' => 'required|max:255',
        'debut_contrat' => 'required|date',
        'poste' => 'required',
        'email' => 'required|email|unique:users',
        'phone' => 'required|int|unique:users',
        ]);
        $sujet='CREATION COMPTE SUR OUTILRH';
        $users = new User();
        $users->Fname= $request->name;
        $users->Lname= $request->fname;
        $users->email= $request->email;
        $users->phone= $request->phone;
        $users->sm= $request->sm;
        $users->date_contrat= $request->debut_contrat;
        $users->adresse= $request->adresse;
        $users->poste_id = $request->poste;
        $users->numero_compte = $request->compte;
        $users->numero_cnps = $request->cnps;
        $users->phone= $request->phone;
        $users->sexe= $request->sexe;
        $users->nbre_enfant= $request->nbre_enfant;
        $users->identifiant = $request->password; 
        $users->password=Hash::make($request->password); 
        $users->save();
        //dd(Mail::to($request->email)->send(new UserMail($request->name,$request->email,$sujet,$request->password)));
        session()->flash('success', 'Enregistrement a reussit avec success');
        return redirect()->route('users.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $count=User::join('postes','postes.id','=','poste_id')->where('users.id',$id)->count();

        if($count==1){

            $users=User::join('postes','postes.id','=','poste_id')->where('users.id',$id)->select('users.id as id','Fname','Lname','name_poste','date_contrat','phone','email','identifiant','adresse','nbre_enfant','sm','numero_cnps','numero_compte','sexe')->get();

             return view('backend.users.show',compact('users'));

        }else{

            return redirect()->route('users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $count=User::join('postes','postes.id','=','poste_id')->where('users.id',$id)->count();
        $postes=Postes::all();
        if($count==1){

            $users=User::join('postes','postes.id','=','poste_id')->where('users.id',$id)->select('users.id as id','Fname','Lname','name_poste','date_contrat','phone','email','identifiant','adresse','nbre_enfant','sm','numero_cnps','numero_compte','sexe')->get();

             return view('backend.users.edit',compact('users','postes'));

        }else{

            return redirect()->route('users.index');
        }
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
        $validated = $request->validate([
        'name' => 'required|max:255',
        'fname' => 'required|max:255',
        'poste' => 'required',
        'email' => 'required',
        'phone' => 'required',
        ]);

        $users = User::find($id);
        $users->Fname= $request->name;
        $users->Lname= $request->fname;
        $users->email= $request->email;
        $users->phone= $request->phone;
        $users->sm= $request->sm;
        $users->date_contrat= $request->debut_contrat;
        $users->adresse= $request->adresse;
        $users->poste_id = $request->poste;
        $users->numero_compte = $request->compte;
        $users->numero_cnps = $request->cnps;
        $users->phone= $request->phone;
        $users->sexe= $request->sexe;
        $users->nbre_enfant= $request->nbre_enfant;
        $users->identifiant = $request->identifiant;  
        $users->update();
        session()->flash('success', 'Modification a reussit avec success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users= User::find($id);
        $users->delete();
        session()->flash('success', 'Suppression a reussit avec success');
        return redirect()->route('users.index');
    }


    public function importExcelData(Request $request){

        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new UsersImport , $request->file('import_file'));
        return redirect()->back()->with('success', 'Importation a reussit');
    }


    public function getusers()
    {   
        $admin=Admin::find(1);
        $sql=User::join('postes','postes.id','=','poste_id')->orderBy('Fname','desc')->get();
        return view('backend.users.list',compact("sql","admin"));
    }
}
