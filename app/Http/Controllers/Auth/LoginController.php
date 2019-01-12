<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;
class LoginController extends Controller
{

    use AuthenticatesUsers;

    
    protected $redirectTo = '/home';

    
    public function __construct()
    {
        $this->middleware('guest')->except('userLogout');
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        //$this->guard()->logout();
        //$request->session()->invalidate();

        return redirect()->route('home');
    }

    /*Social Login*/
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser=$this->findOrCreatUser($user,$provider);
        Auth::login($authUser,true);
        return redirect()->route('home.dashboard');
        //return $user->id;
    }
    public function findOrCreatUser($user,$provider){
        $authUser=User::where('provider_id',$user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'=>$user->name,
            'email'=>$user->email,
            'provider'=>strtoupper($provider),
            'provider_id'=>$user->id
        ]);
    }
}
