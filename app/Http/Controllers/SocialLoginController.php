<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SocialLoginController extends Controller
{
    //public method
    public function toProvider($driver){
        return Socialite::driver($driver)->redirect();
    }
    public function handleCallback($driver){
        // try{
        $user=Socialite::driver($driver)->stateless()->user();
        $user_account = SocialLogin::where('provider',$driver)->where('provider_id',$user->getId())->first();


        if($user_account){
            // Assign role if not already assigned
            if (!$user_account->user->hasRole('client')) {
                $user_account->user->assignRole('client');
            }
            Auth::login($user_account->user);
            Session::regenerate();
            return redirect()->route('dashboard');
        }

        $db_user = User::where('email', $user->getEmail())->first();
       if($db_user){
            SocialLogin::create([
                'user_id' => $db_user->id,
                'provider' => $driver,
                'provider_id' => $user->getId()
            ]);

            Auth::login($db_user);
            Session::regenerate();
            return redirect()->route('dashboard');
        }else{
            $fullName = $user->getName();
            $names = explode(' ', $fullName, 2);

            $firstName = $names[0] ?? '';
            $lastName = $names[1] ?? '';

            $newUser = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->getEmail(),
                'password' => bcrypt('password'),
            ]);

            SocialLogin::create([
                'user_id' => $newUser->id,
                'provider' => $driver,
                'provider_id' => $user->getId()
            ]);
            $newUser->assignRole('client');
            Auth::login($newUser);
            Session::regenerate();
            return redirect()->route('dashboard');

        }
    //  }catch(\Exception $e){
    //        \Log::error($e->getMessage());
    //      return redirect()->route('login')->with('error', 'Unable to login with '.$driver.' account. Please try again.');
    //   }
    }
}
