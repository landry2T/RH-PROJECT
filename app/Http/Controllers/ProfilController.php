<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\pointages;
use App\Models\conges;
use App\Models\absences;
use App\Models\bulletins;
use DB;

class ProfilController extends Controller
{
    //

    public function getdasboard()
    {
        $id=Auth::user()->id;
        $users=User::find($id);
        $m=date('m');
        $conges = DB::table('config_conges')->where('user_id',$id)->count(); 
        $absences = absences::where('user_id',$id)->count(); 
        $pointages = pointages::where('users_id',$id)->whereMonth("created_at",$m)->where("status",1)->count();
        $bulletins = bulletins::where('user_id',$id)->count();
        return view('frontend.dashboard.index',compact("users","conges","absences","pointages","bulletins"));
    }
}
