<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**  
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); 
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['route' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function login(Request $request){

         $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

             return redirect()->route('bord');    

        }else{
 
          session()->flash('error', 'adresse email ou mot de passe incorrect');
          return redirect()->back(); 

        }

     }

     public function adminLogin(Request $request) {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (\Auth::guard('admin')->attempt($request->only('email','password'), $request->get('remember'))){

            return redirect()->intended('/dashboard');

        }else{

          session()->flash('error', 'adresse email ou mot de passe incorrect');
          return redirect()->back();  
        }
    }

     public function adminLogout(){
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login-view');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}