<?php
namespace Wgnsy\Currency\app\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controller;
use Wgnsy\Currency\app\Models\Currency;

class CurrencyAuthController extends Controller
{

    public function index()
    {
        return view('currency::auth.login');
    }  
      

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('currency::auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("home")->withSuccess('Zarejestrowano');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function home()
    {
        if(Auth::check()){

            $currencies = Currency::all();
        $headers = ['Data','Średni kurs','Kurs Sprzedaży','Kurs Kupna'];
        return view('currency::dashboard')->with('currencies',$currencies)->with('headers',$headers);
        }
  
        return redirect("login")->withSuccess('Musisz sie zalogować aby uzyskać dostęp.');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}