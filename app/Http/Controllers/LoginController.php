<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Socialite;

class LoginController extends Controller
{
    public function postLogin(Request $request){

        $email=$request->email;
        $password=$request->password;
         if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->to('/profile');
        }
        else{
             return redirect()->to('/login')->with('error','Please Check your email and password');

        }
    }

    public function postRegister(Request $request){

        $user=User::where('email',$request->email)->first();
        if($user==NULL){

             if($request->password == $request->password_confirmation){

         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)

        ]);

         if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->to('/');
         }

        }
          else{
        return redirect()->to('/')->with('error','Both passwords dont match');
     }
 }
  else{

        return redirect()->to('/')->with('error','Email already exists');
    }


    }
    public function getLogout(){
        Auth::logout();
        return redirect()->to('/');
    }


     public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return $user->getEmail();
        // $user->token;
    }

}
