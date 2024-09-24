<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\bulletins; 
use App\Models\heures;
use App\Models\avances;
use App\Models\Admin;
use App\Models\User; 
use App\Models\Primes;
use App\Models\pointages;
use Auth;
use DB;
use App\Mail\BulletinEmail;
use Mail;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('backend.bulletins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bulletins=bulletins::join('users','users.id','=','user_id')->select('bulletins.id as id','Fname','Lname','bulletins.created_at as mois','user_id')->get();
        return view('backend.bulletins.create', compact('bulletins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users=User::all();
        $mois=date('m');

        foreach ($users as $user) {
            
          $count=bulletins::whereMonth('created_at', $mois)->where('user_id', $user->id)->count();

          if($count==0){
              
              $name = $user->Fname;
              $email = $user->email;
              $date =date('m');
              $mois=strftime('%b', strtotime($date));
              $sujet='Disponibilité de vos bulletins de salaire par email';
              $bulletins = new bulletins();
              $bulletins->user_id = $user->id;
              $bulletins->save();
              //Mail::to($email)->send(new BulletinEmail($name,$mois,$sujet));
              session()->flash('success', 'Enregistrement a reussit avec success');

          }else{

           session()->flash('error', 'les bulletins de ce mois sont deja disponibles');

          }

        }

        return redirect()->route('bulletins.create'); 
  
    }

    /**
     * Display the specified resource.
     * v  
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
    public function printing($id,$ids)
    {
        $admins=Admin::find(1);
        $users=bulletins::join('users','users.id','=','bulletins.user_id')->join('postes','postes.id','=','users.poste_id')->join('classifications','classifications.id','=','postes.class_id')->where('bulletins.user_id',$ids)->where('bulletins.id',$id)->get();
        $primes=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$users[0]->poste_id)->where('nature_prime','imposable')->get();
    
        $primes1=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$users[0]->poste_id)->where('nature_prime','taxable et pas cotisable')->get();

        $primes2=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$users[0]->poste_id)->where('nature_prime','taxable et cotisable')->get();

        $primes3=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$users[0]->poste_id)->where('nature_prime','idemnité')->get();

        $primes4=Primes::join('config_primes','prime_id','=','primes.id')->where('poste_id',$users[0]->poste_id)->where('nature_prime','conge')->get();

        $mois=date('m');

        $heures=heures::where('users_id',$ids)->whereMonth('created_at',$mois)->get();
        $avances=avances::where('users_id',$ids)->whereMonth('created_at',$mois)->get();
        $pointages=pointages::where('users_id',$ids)->whereMonth('created_at',$mois)->where('status',0)->count();


        return view('backend.bulletins.print',compact('admins','users','primes','primes1','primes2','primes3','primes4','heures','avances','pointages'));
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
        //
    }

    public function getting()
    {
        $id=Auth::user()->id;
        $bulletins = bulletins::where('user_id',$id)->get();
        return view('frontend.dashboard.bulletin',compact('bulletins'));
    }

    public function getfiscalite()
    {
       $fiscales=DB::select('select sum(montant_fiscale) as montant , month(created_at) as mois from fiscales group by month(created_at)');
       return view('backend.bulletins.fiscalite',compact('fiscales'));
    }
}
