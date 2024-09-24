<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pointages;

use App\Models\User;

use Auth;

class pointageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('backend.pointages.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    public function getpointage()
    {
        $id=Auth::user()->id;
        $date=date('Y-m-d');
        $numero=Auth::user()->phone;
        $name=Auth::user()->Fname;
        $messages='Bonjour . '.strtoupper($name).' ,Votre code pour badgé est '.$numero.'';
        $code='';
        for ($i=0; $i<4; $i++) { 
          $code.=mt_rand(0,9); 
        }

        $count=pointages::where('users_id',$id)->whereDate('created_at',$date)->count();
        
        if($count==0){

           $data_json = '{
		       "from":"Infobip",
		       "to":"237691904135",
		       "text":"Bonjour M./Mme '.strtoupper($name).',Votre code pour badgé est '.$code.' ."
		       }';
		       
			    $authorization = base64_encode('LANDRY2T:Landry@1996');
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json',"Authorization: Basic $authorization"));
				curl_setopt($ch, CURLOPT_URL, 'https://api.infobip.com/sms/1/text/single');

				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response  = curl_exec($ch);
				var_dump($response);
				curl_close($ch);

            $pointages = new pointages();
            $pointages->users_id = $id;
            $pointages->token=$code;
            $pointages->save();
            session()->flash('succes', 'un code vous a été envoyé pour confimer votre arrivé');
        }
        
        return view('frontend.dashboard.pointage');
    } 

    public function postpointage(Request $request)
    {
        $id=Auth::user()->id;
        $date=date('Y-m-d');
        $heure_arrive=date('G:i');
        $sql=pointages::where('users_id',$id)->whereDate('created_at',$date)->get();
        $code= $sql[0]->token;
        if($code == $request->code){

            if($sql[0]->time_in==null){

                 if($heure_arrive <= 11){

                    $count=pointages::where('users_id',$id)->whereDate('created_at',$date)->update(['time_in'=>$heure_arrive , 'status'=>1]);
                     session()->flash('success', 'votre pointage a été enregistrer avec success');  
                     return redirect()->route('pointage');

                 }else{

                      $count=pointages::where('users_id',$id)->whereDate('created_at',$date)->update(['time_in'=>$heure_arrive]);
                     session()->flash('success', 'votre pointage a été enregistrer avec success');  
                     return redirect()->route('pointage');                 
                 }

            }else{

              session()->flash('error', 'votre pointage du matin a déja été enregistrer..');  
              return redirect()->route('pointage');    
            }

        }else{
          session()->flash('error', 'votre code est érroné , veuillez reessayer');  
          return redirect()->route('pointage'); 
        }  
    }

   public function edited(Request $request)
   {

      if($request->heure_arrive < 9){

         pointages::where('users_id', $request->user_id)->where('created_at', $request->create)->update(['time_in'=>$request->heure_arrive,'time_out'=>$request->heure_depart , 'status'=>"1"]);
         session()->flash('success', 'Modification a reussit avec success');  
          return redirect()->route('pointages.index');
           
      }else{

        session()->flash('error', 'votre Modification a échoue , merci de justifier aupres de la DRH');  
          return redirect()->route('pointages.index');
      } 

   }



}
